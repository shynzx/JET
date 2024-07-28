CREATE DATABASE JET;

USE JET;

CREATE TABLE users(
	id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    user_password VARCHAR(100) NOT NULL
);

ALTER TABLE users
ADD COLUMN profile_image LONGBLOB;

CREATE TABLE tasks(
	id_task INT PRIMARY KEY AUTO_INCREMENT,
    task_title VARCHAR(100) NOT NULL,
    task_body VARCHAR(500) NOT NULL,
    finish_date DATETIME NOT NULL,
    task_status VARCHAR(15) NOT NULL
);

CREATE TABLE user_tasks_tags (
    id_user INT NOT NULL,
    id_task INT NOT NULL,
    tagname VARCHAR(40) NOT NULL,
    PRIMARY KEY (id_user, id_task, tagname),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_task) REFERENCES tasks(id_task)
);

CREATE TABLE notes(
	id_note INT PRIMARY KEY AUTO_INCREMENT,
    note_title VARCHAR(100) NOT NULL,
    note_body LONGTEXT,
    creation_date DATE NOT NULL
);
	
CREATE TABLE user_notes_tags (
    id_user INT NOT NULL,
    id_note INT NOT NULL,
    tagname VARCHAR(40) NOT NULL,
    PRIMARY KEY (id_user, id_note, tagname),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_note) REFERENCES notes(id_note)
);

DELIMITER //
CREATE PROCEDURE InsertUser(
    IN p_username VARCHAR(50),
    IN p_email VARCHAR(70),
    IN p_user_password VARCHAR(100)
)
BEGIN
    DECLARE email_exists INT;

    -- Verificar si el email ya existe
    SELECT COUNT(*) INTO email_exists
    FROM users
    WHERE email = p_email;

    -- Si el email no existe, insertar el nuevo usuario
    IF email_exists = 0 THEN
        INSERT INTO users (username, email, user_password)
        VALUES (p_username, p_email, p_user_password);
    ELSE
        -- Lanzar un error si el email ya existe
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo electrónico ya está en uso.';
    END IF;
END //
DELIMITER ;

SELECT * FROM users;
SELECT * FROM tasks;
SELECT * FROM user_tasks_tags;
DELETE FROM tasks WHERE id_task = 6;
UPDATE tasks SET task_status = 'completada' WHERE id_task = 5;
CALL CreateTaskWithTags(6,'Nueva Tarea', 'Hacer un resumen de la computación a traves de los años ', '2024-07-26 15:00:00','etiqueta1,etiqueta2,etiqueta3');

DELIMITER //
CREATE PROCEDURE CreateTaskWithTags(
    IN userId INT,
    IN taskTitle VARCHAR(100),
    IN taskBody VARCHAR(500),
    IN finishDate DATETIME,
    IN tags VARCHAR(255)
)
BEGIN
    DECLARE taskId INT;
    DECLARE tag VARCHAR(40);
    DECLARE tagList TEXT;
    DECLARE commaPos INT;
    
    DECLARE exit handler for SQLEXCEPTION 
    BEGIN
        -- Rollback the transaction if an error occurs
        ROLLBACK;
        SELECT 'Error occurred, transaction rolled back' AS error_message;
    END;

    -- Inicio de la transacción
    START TRANSACTION;
    
    -- Insertar la tarea en la tabla tasks
    INSERT INTO tasks (task_title, task_body, finish_date, task_status)
    VALUES (taskTitle, taskBody, finishDate, 'pendiente');
    
    -- Obtener el ID de la tarea recién insertada
    SET taskId = LAST_INSERT_ID();
    
    -- Manejar las etiquetas si se proporcionaron
    IF tags IS NOT NULL AND tags != '' THEN
        SET tagList = tags;
        WHILE LENGTH(tagList) > 0 DO
            SET commaPos = LOCATE(',', tagList);
            IF commaPos > 0 THEN
                SET tag = TRIM(SUBSTRING(tagList, 1, commaPos - 1));
                SET tagList = SUBSTRING(tagList, commaPos + 1);
            ELSE
                SET tag = TRIM(tagList);
                SET tagList = '';
            END IF;
            INSERT INTO user_tasks_tags (id_user, id_task, tagname)
            VALUES (userId, taskId, tag);
        END WHILE;
    END IF;
    
    -- Confirmar la transacción
    COMMIT;
END //
DELIMITER ;

SELECT * FROM user_tasks_view where id_user = 6;

CREATE VIEW user_tasks_view AS
SELECT
    t.id_task,
    t.task_title,
    t.task_body,
    t.finish_date,
    t.task_status,
    utt.id_user,
    COALESCE(GROUP_CONCAT(utt.tagname ORDER BY utt.tagname SEPARATOR ', '), 'Sin etiqueta') AS tags
FROM
    tasks t
LEFT JOIN
    user_tasks_tags utt ON t.id_task = utt.id_task
GROUP BY
    t.id_task, t.task_title, t.task_body, t.finish_date, t.task_status, utt.id_user;
    SELECT * FROM tasks;
CALL UpdateTaskWithTags(1, 6, 'Actualizacion', 'Contenido actualizado', '2024-07-27 15:00:00', 'sin etiqueta');

DELIMITER //
CREATE PROCEDURE UpdateTaskWithTags(
    IN taskId INT,
    IN userId INT,
    IN taskTitle VARCHAR(100),
    IN taskBody VARCHAR(500),
    IN finishDate DATETIME,
    IN tags VARCHAR(255)
)
BEGIN
    DECLARE tag VARCHAR(40);
    DECLARE tagList TEXT;
    DECLARE commaPos INT;
    
    DECLARE exit handler for SQLEXCEPTION 
    BEGIN
        ROLLBACK;
        SELECT 'Error occurred, transaction rolled back' AS error_message;
    END;

    START TRANSACTION;
    
    -- Actualizar la tarea en la tabla tasks
    UPDATE tasks
    SET task_title = taskTitle,
        task_body = taskBody,
        finish_date = finishDate
    WHERE id_task = taskId;
    
    -- Eliminar las etiquetas existentes para la tarea
    DELETE FROM user_tasks_tags
    WHERE id_task = taskId AND id_user = userId;
    
    -- Manejar las etiquetas si se proporcionaron
    IF tags IS NOT NULL AND tags != '' THEN
        SET tagList = tags;
        WHILE LENGTH(tagList) > 0 DO
            SET commaPos = LOCATE(',', tagList);
            IF commaPos > 0 THEN
                SET tag = TRIM(SUBSTRING(tagList, 1, commaPos - 1));
                SET tagList = SUBSTRING(tagList, commaPos + 1);
            ELSE
                SET tag = TRIM(tagList);
                SET tagList = '';
            END IF;
            INSERT INTO user_tasks_tags (id_user, id_task, tagname)
            VALUES (userId, taskId, tag);
        END WHILE;
    END IF;
    
    COMMIT;
END //
DELIMITER ;

SELECT * FROM tasks;
user_password
DELIMITER //
CREATE PROCEDURE DeleteTaskAndTags(
    IN taskId INT,
    IN userId INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
    BEGIN
        -- Rollback the transaction if an error occurs
        ROLLBACK;
        SELECT 'Error occurred, transaction rolled back' AS error_message;
    END;

    -- Start transaction
    START TRANSACTION;

    -- Delete from user_tasks_tags
    DELETE FROM user_tasks_tags WHERE id_task = taskId AND id_user = userId;

    -- Delete from tasks
    DELETE FROM tasks WHERE id_task = taskId;

    -- Commit the transaction
    COMMIT;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE update_password(
	IN p_email VARCHAR(70),
    IN p_user_password VARCHAR(100)
    )
    BEGIN
    DECLARE email_exists INT;

    -- Verificar si el email ya existe
    SELECT COUNT(*) INTO email_exists
    FROM users
    WHERE email = p_email;

    -- Si el email no existe, insertar el nuevo usuario
    IF email_exists = 1 THEN
        UPDATE users SET user_password = p_user_password WHERE p_email = email;
    ELSE
        -- Lanzar un error si el email ya existe
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo electrónico no está en uso.';
    END IF;
END;
//
DELIMITER ;



select * from users
