<?php
    include 'connection.php';
    include 'codeGenerator.php';

    $studentStmt = $conn->query("SELECT id, student_name FROM student ORDER BY student_name ASC");
    if (!$studentStmt) {
        print_r($conn->errorInfo());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="universal.css">
    <link rel="stylesheet" href="login.css">
    <title>Lagin</title>
</head>
<body class="bgc">
    <div class="loginContainer">
        <div class="loginBody">
            <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                <h1>Login</h1>
                <p style="font-size: var(--font-seccondary-size); color: #989898;">Please enter your identity, Stranger.</p>
            </div>
            

            <form class="">
                <div class="d-flex flex-column gap-2 mb-3">
                    <label for="student_name">Your Name</label>
                    <input type="text" id="student_name" list="student_list" class="form-control" 
                            name="student_name" placeholder="Select your name" 
                            required>
                    <datalist id="student_list" >
                        <?php
                            while ($row = $studentStmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['student_name'] . "'>";
                            }
                        ?> 
                    </datalist>
                </div>
                <div class="d-flex flex-column gap-2 mb-3">
                    <label for="student_no">Student Number</label>
                    <input type="text" id="student_no" class="form-control" 
                            name="student_no" placeholder="2023102XXX" 
                            required>
                </div>

                <div>
                    <p style="font-size: var(--font-tertiary-size); color: #989898;">Please double check your name before clicking the login button.</p>
                    <button class="btn" id="loginButton" style="width: 100%; background-color: var(--navbar-color); color: white;">Login</button>
                </div>

                <div>

            <form>
            
        </div>
        
    </div>
</body>
</html>