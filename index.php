<?php
    ob_start();
    include 'connection.php';
    include 'codeGenerator.php';
    include 'currentSched.php';
    $page = $_GET['page'] ?? 'check-in';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="universal.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Attendance</title>
    
</head>
<body>
    <div class="grid-wrapper">
        <?php include 'navbar.php'; ?>
        <main class="main-grid">
            <?php
                switch($page){
                    case 'dashboard': include 'dashboard.php'; break;
                    case 'register': include 'register.php'; break;
                    default: include 'check-in.php';
                }
            ?>  
        </main>
    </div>
    <script src="clock.js"></script>
    <script src="universal.js"></script>
</body>
</html>