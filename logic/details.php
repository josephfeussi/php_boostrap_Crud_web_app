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

        if (!$student) {
            header("Location: ../index.php");
            $_SESSION["message"] ="Student Not found in DataBase";
        } 
        
    }else{
        header("Location: ../index.php");
        $_SESSION['message'] = "No rights to access this resource !";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Details <?= $student["name"]?></title>
</head>
<body>
    <main class="container">
        <div class="col-md-12 mt-5">
            <h1>Student : <?= $student["name"]?></h1>
            <p>Name  : <?= $student["name"]?></p>
            <p>Surname  :<?= $student["surname"]?></p>
            <p>Age  :<?= $student["age"]?> </p>
            <a href="../index.php" class="btn btn-danger">Back</a>
        </div>
    </main>
</body>
</html>