
<?php 
    $presentStmt =
    "SELECT s.*, COUNT(a.id) as total_attendance
     FROM schedules s LEFT JOIN attendance a 
     ON s.id = a.sched_id GROUP BY s.id";      
    $stmt = $conn->query($presentStmt);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($courses as $course): ?>
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
                <p class="p-1 mb-1"><?= $course['total_attendance'] ?></p>
                <p class="p-1 mb-1"><?= $course['total_attendance'] ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>  
