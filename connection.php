<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "studentattendance";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>