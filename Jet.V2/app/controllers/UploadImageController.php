<?php
// She's real to me.


class UploadImage
{
    public function upload_image($id_user, $imagen){
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();
    
        try {
            $query = "CALL upload_image(:u_id_user, :u_image)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':u_id_user', $id_user);
            $stmt->bindParam(':u_imagen', $imagen);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function select_image($id_user) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();
    
        try {
            $query = "CALL select_img(:userid)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':userid', $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
