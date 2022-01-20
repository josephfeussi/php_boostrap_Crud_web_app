<?php
    session_start();
    require_once("../bd/connection.php");

    if($_GET["id"] && !empty($_GET["id"])){
        $id = strip_tags($_GET['id']);

        $sql = "SELECT * FROM student WHERE id=:id";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt-> execute();

        $student= $stmt-> fetch();

        if ($student) {
               $id = strip_tags($_GET['id']);

               $sql = "DELETE FROM student WHERE id=:id";
    
               $stmt = $db->prepare($sql);

               $stmt->bindParam(':id', $id);
    
               $stmt->execute();
                
               header("Location: ../index.php");
               $_SESSION["message"] ="Student Deleted successfully !";
            
        } else {
            header("Location: ../index.php");
            $_SESSION["message"] ="Student Not found in DataBase";
        }
        
        
    }else{
        header("Location: ../index.php");
        $_SESSION['message'] = "No rights to access this resource !";
    }
?>
