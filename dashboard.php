
<?php 
    $attendanceStmt =
    "SELECT s.*, 
        (SELECT COUNT(*) FROM enrollments e WHERE e.sched_id = s.id) as total_enrolled,
        COUNT(a.id) as total_attendance,
        SUM(CASE WHEN TIME(a.time_in) > TIME(s.start_time, '+' || ? || 'minutes')
            THEN 1 ELSE 0 END) as total_late
     FROM schedules s LEFT JOIN attendance a 
     ON s.id = a.sched_id AND DATE(a.time_in) = DATE('now') 
     GROUP BY s.id"; 

    /* $stmt = $conn->query($presentStmt); */
   
    
    //           grace period + connection issue + no. stud consideration + lastMinute
    $gracePeriod = 15 + 5 + 20 + 5; 
    /* $lateStmt = 
        "SELECT COUNT(a.id) as total_late 
         FROM attendance a
         LEFT JOIN schedules s ON a.sched_id = s.id
            AND TIME(a.time_in) > TIME(s.start_time, '+' || ? || 'minutes')
            AND DATE(a.time_in) = DATE('now')
         GROUP BY s.id"; */

    $stmt = $conn->prepare($attendanceStmt);
    $stmt->execute([$gracePeriod]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>  

<?php foreach ($courses as $course): ?>
    <?php $totalAbsent = $course['total_enrolled'] - $course['total_attendance'];?>
    <div class="MyCard dashboard">
        <h5 id="course_name"><?= htmlspecialchars($course['course_name']) ?></h5>
        <h6><?= htmlspecialchars($course['course_code'])?></h6>
        <div class="d-flex flex-row gap-5 mt-3 mb-0">
            <div class="mb-0">
                <p class="card text-white bg-success p-1 mb-1 text-center">Total Present</p>
                <p class="card text-white bg-danger p-1 mb-1 text-center">Total Absents</p>
                <p class="card text-white bg-warning p-1 mb-1 text-center">Total Tardy</p>
            </div>
            <div class="mb-0">
                <p class="p-1 mb-1"><?= $course['total_attendance'] ?></p>
                <p class="p-1 mb-1"><?= $totalAbsent ?></p>
                <p class="p-1 mb-1"><?= $course['total_attendance'] ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>  
