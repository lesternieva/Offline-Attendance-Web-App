<?php
    ob_start();
    session_start();
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_no = trim($_POST['reg-student-no'] ?? '');
        $student_name = trim($_POST['reg-student-name'] ?? '');
        $selectedSubjects = $_POST['subjects'] ?? [];

        if ($student_name === '' || $student_no === '') {
            $_SESSION['message'] = "Ayan, magsa-submit kulang-kulang. Make sure to complete the required inputs.";
            $_SESSION['message_type'] = "error";
        } else if (empty($selectedSubjects)) {
            $_SESSION['message'] = "Di ka ba nag-enroll? Please select subjects you're enrolled into.";
            $_SESSION['message_type'] = "error";
        } else {
            try{
                $conn->beginTransaction(); // as a good practice when inserting into two tables

                $createStudent = $conn->prepare(
                    "INSERT INTO student (student_no, student_name) VALUES (?, ?)"
                );
                $createStudent->execute([$student_no, $student_name]);

                $enrollStudent = $conn->prepare(
                    "INSERT INTO enrollments (student_id, sched_id) VALUES (?, ?)"
                );

                $studentID = $conn->lastInsertId();
                if (!$studentID) {
                    throw new Exception("Failed to retrieve student ID.");
                }

                $enrollStudent = $conn->prepare(
                    "INSERT INTO enrollments (student_id, sched_id) VALUES (?, ?)"
                );

                // for subject mapping -> this might need more scalability
                $subjectMap = [];
                $query = $conn->query("SELECT id, course_name FROM schedules");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $courseName = $row['course '];

                    $subjectMap[$row['course_name']] = $row['id'];

                }

                

                foreach ($selectedSubjects as $name) {
                    if(isset($subjectMap[$name])){
                        $schedID = $subjectMap[$name];

                        $enrollStudent->execute([$studentID, $schedID]);
                    }
                }

                $conn->commit();

                $_SESSION['message'] = "Diba, madali lang? Registered successfully.";
                $_SESSION['message_type'] = "success";  
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    $_SESSION['message'] = "Pauulit-ulit ka? Registered an yung student number na 'yan nak. Please contact your secretary if you think this is a mistake."/*  . $e */;
                    $_SESSION['message_type'] = "error";
                } else {
                    // Print the specific database error message
                    $_SESSION['message'] = "Database Error: " . $e->getMessage();
                    $_SESSION['message_type'] = "error";
                }
            
            }
        }

        header("Location: index.php?page=register");
        exit;
    }
?>


<?php if (isset($_SESSION['message'])): // check if  ?>
    
    <div id="registrationMessage" class="messageBox <?php echo $_SESSION['message_type']; ?>">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php
        // clear message so it does not appear after (2nd) refresh
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    ?>
<?php endif; ?>


<div class="MyCard register">
    <h5>Student Registration Form</h5>
    <form method="POST" action=''>
        <div>
            <p style="font-size: var(--font-tertiary-size);">YOUR NAME</p>
            <input type="text" id="reg-student-name" list="student_list" class="form-control" 
                name="reg-student-name" placeholder="Ex. Swift, Taylor B." 
                required>
        </div>

        <div class="d-flex flex-column gap-2" style="margin-top: 1rem;">
            <p style="font-size: var(--font-tertiary-size);">STUDENT NO.</p>
            <input type="text" id="reg-student-no" name="reg-student-no" class="form-control" placeholder="2023102ABC" style="width: 100%;" require>
        </div>
        
        <div class="form-group">
            <label class="mb-2">Courses/Subjects:</label>
            <div class="checkbox-group">
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-1" type="checkbox" id="selectAllSubjects" name="selectAllSubjects" value="all">
                    <label for="selectAllSubjects">All Subjects</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-1" type="checkbox" id="entrepreneurial" name="subjects[]" value="The Entrepreneurial Mind">
                    <label for="entrepreneurial">The Entrepreneurial Mind</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-1" type="checkbox" id="real_analysis" name="subjects[]" value="Real Analysis">
                    <label for="real_analysis">Real Analysis</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-1" type="checkbox" id="thesis1" name="subjects[]" value="Thesis 1">
                    <label for="thesis1">Thesis 1</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-1" type="checkbox" id="rizal" name="subjects[]" value="Life and Works of Rizal">
                    <label for="rizal">Life and Works of Rizal</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-2" type="checkbox" id="networking_design" name="subjects[]" value="Computer Networking Design">
                    <label for="networking_design">Computer Networking Design</label>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-start gap-2">
                    <input class="mt-2" type="checkbox" id="networking_lab" name="subjects[]" value="Computer Networking Design Lab">
                    <label for="networking_lab">Computer Networking Design Lab</label>
                </div>
            </div>
        </div>


        
        <button type="submit" class="btn" style="background-color: var(--primary-color); color: var(--secondary-color)">Register</button>
    </form>

    <script>
        // for disabling other check boxes whin "ALl.." is ticked
        const allCheckbox = document.getElementById('selectAllSubjects');
        const subjectCheckboxes = document.querySelectorAll('input[name="subjects[]"]');

        allCheckbox.addEventListener('change', function() {
            subjectCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                /* checkbox.disabled = this.checked; */
            });
        });

        subjectCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const anyChecked = Array.from(subjectCheckboxes).some(cb => cb.checked);
                allCheckbox.disabled = anyChecked;
                if (anyChecked) {
                    allCheckbox.checked = false;
                }
            });
        });
    </script>
</div>