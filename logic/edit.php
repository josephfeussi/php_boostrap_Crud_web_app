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
            if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['age']) ) {
                
                $name = strip_tags($_POST['name']);
                $surname = strip_tags($_POST['surname']);
                $age = strip_tags($_POST['age']);
    
               $sql = "UPDATE student SET name=:name, surname=:surname, age=:age WHERE id=:id";
    
               $stmt = $db->prepare($sql);
    
               $stmt->bindParam(':name', $name);
               $stmt->bindParam(':surname', $surname);
               $stmt->bindParam(':age', $age);
               $stmt->bindParam(':id', $id);
    
               $stmt->execute();
                
               header("Location: ../index.php");
               $_SESSION["message"] ="Student Edited successfully";
            }

        } else {
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
    <title>Editing</title>
</head>
<body>
<main class="container mt-5">
        <div class="col-md-12">
            
            <h1>Editing a Student : <?= $student['name']?></h1>
            <div class="col-md-6">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Name </label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $student['name']?>">
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname </label>
                        <input type="text" name="surname" id="surname" class="form-control" value="<?= $student['surname']?>">
                    </div>

                    <div class="form-group">
                        <label for="age">Age </label>
                        <input type="number" name="age" id="age" class="form-control" value="<?= $student['age']?>">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <a href="../index.php" class="btn btn-danger">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>