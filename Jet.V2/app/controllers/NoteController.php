<?php
class NoteController{

    public function createNote($userId, $title, $tags, $content) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "CALL CreateNoteWithTags(:userId, :title, :content, :tags)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':tags', $tags);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUserNotes($userId) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "SELECT * FROM user_notes_view WHERE id_user = :user_id";
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

    public function getNoteById($noteId) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();
    
        try {
            $query = "SELECT * FROM user_notes_view WHERE id_note = :note_id";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':note_id', $noteId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function editNote($idNote, $idUser, $noteTitle, $content, $tags){
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try{
            $query = "CALL UpdateNoteWithTags(:id_note, :id_user, :note_title, :note_body, :tags)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':id_note', $idNote);
            $stmt->bindParam(':id_user', $idUser);
            $stmt->bindParam(':note_title', $noteTitle);
            $stmt->bindParam(':note_body', $content);
            $stmt->bindParam(':tags', $tags);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            return false;
        }
        
    }

    public function deleteNote($idNote, $idUser) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "CALL DeleteNoteAndTags(:id_note, :id_user)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':id_note', $idNote);
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