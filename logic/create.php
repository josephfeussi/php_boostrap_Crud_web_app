<?php
    session_start(); //to store a message that would be used else where

    require_once("../bd/connection.php");

    if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["age"])) {
        //prevent sql injections
        $name = strip_tags($_POST['name']);
        $surname = strip_tags($_POST['surname']);
        $age = strip_tags($_POST['age']);

        $sql = "INSERT INTO student SET name=:name, surname=:surname, age=:age";

        $stmt = $db->prepare($sql);
        

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':age', $age);


        # $stmt-> execute();
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }

        $_SESSION["message"] = "A new student was succesfully added";
        header('Location: ../index.php');
    } else {
        $_SESSION["message"] = "All fields must be filled ";
        # die();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Create Student</title>
</head>

<body>
    <main class="container mt-5">
        <div class="col-md-12">

            <h1>Creating a Student</h1>
            <div class="col-md-6">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Name </label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname </label>
                        <input type="text" name="surname" id="surname" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="age">Age </label>
                        <input type="number" name="age" id="age" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="../index.php" class="btn btn-danger">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>