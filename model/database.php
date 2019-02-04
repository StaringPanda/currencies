<?php
    $dsn = 'mysql:host=localhost;dbname=D00210089';
    $username = 'D00210089';
    $password = 'ChQwerrI';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>