<?php
class Controller {
    private $db;

    function __construct($conn) {
        $this->db = $conn;
    }

    function getInfo() {
        try {
            $sql = "SELECT * FROM users";
            $result = $this->db->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function getUserById($id) {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function delete($id){
        try {
            $sql = "DELETE FROM users WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
}
?>
