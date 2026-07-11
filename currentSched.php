<?php
    include 'connection.php';

    $today = 'Wednesday'/* date("l") */; 
    $sql = "SELECT id, course_code, course_name FROM schedules
            WHERE day_of_week = ?
            AND ? BETWEEN start_time AND end_time";

    $stmt = $conn->prepare($sql);
    date_default_timezone_set('Asia/Manila');
    $stmt->execute([$today, '15:45:00'/* date("H:i:s") */]);
    $activeSchedule = $stmt->fetch(PDO::FETCH_ASSOC);
    $course_id = $activeSchedule['id'] ?? '';

    
    if ($activeSchedule) {
        $course_code = $activeSchedule['course_code'];
        $course_name = $activeSchedule['course_name'];
    } else {
        $course_code = "No class";
        $course_name = "";
    }

?>