<?php
    /* $host = "localhost";
    $username = "root";
    $password = "";
    $database = "studentattendance";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    } */

    try{
        $conn = new PDO("sqlite:" . __DIR__ . "/attendance.db");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->exec('PRAGMA foreign_keys = ON;'); // SQLite needs this explicitly turned on
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>