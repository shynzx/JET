<?php
class TaskController{

    public function createTask($userId, $title, $tags, $content, $finishDate) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "CALL CreateTaskWithTags(:userId, :title, :content, :finishDate, :tags)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':finishDate', $finishDate);
            $stmt->bindParam(':tags', $tags);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUserTasks($userId) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "SELECT * FROM user_tasks_view WHERE id_user = :user_id";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            
            // Fetch all results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        
    }

    public function updateTaskStatus($taskId, $status) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try{
            $query = "UPDATE tasks SET task_status = :task_status WHERE id_task = :task_id";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            $stmt->bindParam(':task_status', $status, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getTaskById($taskId) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();
    
        try {
            $query = "SELECT * FROM user_tasks_view WHERE id_task = :task_id";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':task_id', $taskId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function editTask($idTask, $idUser, $taskTitle, $content, $finishDate, $tags){
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try{
            $query = "CALL UpdateTaskWithTags(:id_task, :id_user, :task_title, :task_body, :finish_date, :tags)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':id_task', $idTask);
            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':task_title', $taskTitle);
            $stmt->bindParam(':task_body', $content);
            $stmt->bindParam(':finish_date', $finishDate);
            $stmt->bindParam(':tags', $tags);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            return false;
        }
        
    }

    public function deleteTask($idTask, $idUser) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "CALL DeleteTaskAndTags(:id_task, :id_user)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':id_task', $idTask);
            $stmt->bindParam(':id_user', $idUser);
            $stmt->execute();

            // Check if any row was affected
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}
?>