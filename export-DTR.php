<?php
    session_start();
    include 'connection.php';
    
    $studentNumber = $_GET['student_no'] ?? '';
    $from = $_GET['from'] ?? '';
    $to = $_GET['to'] ?? '';

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

    $schedules = $conn->query(
        "SELECT id, course_name FROM schedules"
    );

    $timeInForCourses = $conn->prepare(
        "SELECT 
            DATE(att.time_in) as log_date,
            CASE 
                WHEN ((TIME(att.time_in) > TIME(sc.start_time, '+' || ? || ' minutes')) 
                AND (DATE(time_in) BETWEEN ? AND ?)) 
                    THEN 'L'
                    ELSE 'P'
            END AS status
        FROM attendance att
        JOIN schedules sc ON  att.sched_id = sc.id
        JOIN student st ON att.student_id = st.id
        WHERE sc.id = ? AND st.student_no = ?
        ORDER BY att.time_in ASC;"
    );

    $gracePeriod = 15 + 5 + 20 + 5;
    $startDate = new DateTime($from);
    $endDate = new DateTime($to);
    $endDate->modify('+1 day'); // an incrase of date because the next logid DatePeriod exclude the end date

    $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate); // the middle variable just tells that the Period interval increases by 1 Day

    

    while ($row = $schedules->fetch(PDO::FETCH_ASSOC)) {
        $attendance = [];
        $courseID = $row['id'];
        $courseName = $row['course_name'];
        $timeInForCourses->execute([$gracePeriod, $from, $to, $courseID, 
                                    $studentNumber]);

        while ($att = $timeInForCourses->fetch(PDO::FETCH_ASSOC)){
            if (isset($att['log_date']) && isset($att['status'])) {
                $attendance[$att['log_date']] = $att['status'];
            }
        }
        
        // just for testing
        foreach ($period as $date) {
            $currentDate = $date->format('Y-m-d');
            echo $courseName . " (" . $currentDate . ") - ";
            
            // Use null coalescing to provide a default if the key isn't in the array
            echo $attendance[$currentDate] ?? "A";
            echo "<br>";
        }
        
        
    }   

?>