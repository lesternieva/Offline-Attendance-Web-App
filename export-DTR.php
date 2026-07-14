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
        "SELECT id, course_name, day_of_week FROM schedules"
    );

    // to unify same subject course just different name
    $courseMap = [];
    $courseDay = [];
    while ($row = $schedules-> fetch(PDO::FETCH_ASSOC)) {
        $courseMap[$row['course_name']][] = $row['id'];
        $courseDay[$row['course_name']][] = $row['day_of_week'];
    }


    $gracePeriod = 15 + 5 + 20 + 5;
    $startDate = new DateTime($from);
    $endDate = new DateTime($to);
    $endDate->modify('+1 day'); // an incrase of date because the next logid DatePeriod exclude the end date
    

   

    $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate); // the middle variable just tells that the Period interval increases by 1 Day

    // for CSV file
    $matrix = [];
    $summary = [];
    $courseNamesForCSV = array_keys($courseMap); // this just copu and preserves the column order


    foreach ($courseMap as $courseName => $schedIDs) {
        $attendance = [];
        $summary[$courseName] = ['P' => 0, 'A' => 0, 'L' => 0];
        // this makes an array of that count whose elements is ? separated by ,
        $placeholder = implode(',', array_fill(0, count($schedIDs), '?'));

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
            LEFT JOIN student st ON att.student_id = st.id
            WHERE sc.id IN ($placeholder) AND st.student_no = ?
            ORDER BY att.time_in ASC;"
        );

        /* $courseID = $row['id'];
        $courseName = $row['course_name']; */
        $params = array_merge([$gracePeriod, $from, $to], $schedIDs, [$studentNumber]);
        $timeInForCourses->execute($params);

        while ($att = $timeInForCourses->fetch(PDO::FETCH_ASSOC)){
            if (isset($att['log_date']) && isset($att['status'])) {
                $attendance[$att['log_date']] = $att['status'];
            }
        }
        
        
        foreach ($period as $date) {
            $currentDate = $date->format('Y-m-d');
            $dayOfCurrentDate = $date->format('l');
            $status  = $attendance[$currentDate] ?? 'A';

            if (!isset($courseDay[$courseName]) || !in_array($dayOfCurrentDate, $courseDay[$courseName], true)){
                $matrix[$currentDate][$courseName] = '--';
                continue;
            }


            $matrix[$currentDate][$courseName] = $status;

            // just for summary on the very bottom of csv
            if (isset($summary[$courseName][$status])) $summary[$courseName][$status]++;
        }   
    }   

    // contruction of DTR-CSV data
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="attendance_' . $studentNumber . '.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, array_merge(['Date'], $courseNamesForCSV)); // this would literally put Date and courseNames on on the first row
    foreach ($matrix as $date => $courses) {
        $dateWithDay = $date . ' (' . ((new DateTime($date))->format('D')) . ')';

        $status = [$dateWithDay]; // status (P, L, A) on that day
        foreach ($courseNamesForCSV as $c) {
            $status[] = $courses[$c] ?? 'hatdog';
        }
        fputcsv($output, $status); // then put the status on rows for each Courses on that day 
    }

    // this will just put 1 row blank space
    fputcsv($output, array_fill(0, count($courseNamesForCSV) + 1, ''));

    $labels = ['P' => 'Present Days',  'A' => 'Absences', 'L' => 'Late Count'];

    foreach ($labels as $key => $label) {
        $status = [$label];
        foreach($courseNamesForCSV as $courseName) {
            $status[] = $summary[$courseName][$key] ?? 0;
        }
        fputcsv($output, $status);
    }
    fclose($output);
    exit;
?>