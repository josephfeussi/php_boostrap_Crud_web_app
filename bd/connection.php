<?php

    $dsn = "mysql:host=127.0.0.1;port=3306;dbname=test";

    try {
        $db = new PDO($dsn,"root","");
    } catch (PDOException $ex) {
        echo "Eror : ". $ex ;
        die();
    }

?>