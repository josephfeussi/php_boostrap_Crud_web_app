<?php
    session_start();
    require_once("bd/connection.php");

    $sql = "SELECT * FROM student";

    $stmt = $db->prepare($sql);

    $stmt-> execute();

    $students = $stmt -> fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Students App</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <section class="col-md">
                
            <?php
                if($_SESSION["message"]){
            
            ?>
                <div class="alert">
                    <p class="alert alert-success">
                        <?php
                            echo $_SESSION["message"];
                            $_SESSION["message"] ='';
                        ?>
                    </p>
                </div>
            <?php
                }
            ?>

                <h1>Student List</h1>
                <a href="logic/create.php" class="btn btn-primary"> Add Student</a>
                <table class="table mt-4">
                    <thead>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>SURNAME</th>
                        <th>AGE</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student){ ?>
                        <tr>
                            <td><?= $student["id"]?></td>
                            <td><?= $student["name"]?></td>
                            <td><?= $student["surname"]?></td>
                            <td><?= $student["age"]?></td>
                            <td>
                                <a href="logic/details.php?id=<?=$student["id"] ?>" class="text-blue">Detail</a>
                                <a href="logic/edit.php?id=<?=$student["id"] ?>" class="text-success">Edit</a>
                                <a href="logic/delete.php?id=<?=$student["id"] ?>" class="text-danger">Delete</a>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>