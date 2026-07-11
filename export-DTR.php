<?php
    session_start();
    include 'connection.php';
    
    $studentNumber = $_GET['student_no'] ?? '';
    $from = $_GET['from'] ?? '';
    $to = $GET['to'] ?? '';

    if($from === '' || $to === '') {
        $_SESSION['message'] = "Pakikumpleto yung dates.";
        $_SESSION['message_type'] = "error";
        header("Location: index.php?page=reports");
        exit;
    } else if ($studentNumber === '') {
        $_SESSION['message'] = "Eh paanong makakagawa ng DTR niyan, walang Student Number?";
        $_SESSION['message_type'] = "error";
        header("Location: index.php?page=reports");
        exit;
    }

    $stmt = $conn->prepare(
        "SELECT  "
    );

?>