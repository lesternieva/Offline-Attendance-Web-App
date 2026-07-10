
<?php
    // for datalist
    $studentStmt = $conn->query("SELECT id, student_name FROM student WHERE status = 'active' ORDER BY student_name ASC");
    if (!$studentStmt) {
        print_r($conn->errorInfo());
    }
    // for checking the active schedule
    if($activeSchedule) {
        $gateCode = getGateCode($conn, $activeSchedule['id'], $activeSchedule['course_code']);
        
    } else {
        $gateCode = "ಠ▃ಠ";
    }
?>
<div id="reminders" class="reminders">
    <p style="font-size-: var(--font-tertiary-size);">Be fair! Don't check-in absentees.
    One check-in per device, per session.
    Code is valid for 45 minutes only.</p>
</div>
<div id="sessionCard" class="MyCard checkin">
    <div>
        <span class="d-flex flex-row justify-content-between primaryColor" style="color: var(--navbar-color); font-size: var(--font-tertiary-size);">
            <p>SESSION</p> 
            <p>GATE CODE</p> 
        </span>
        <span class="d-flex flex-row justify-content-between gap-3" style="font-size: var(--font-primary-size);">
            <p id="session_date" style="font-size: var(--font-secondary-size);"><?php echo date("F j"); ?></p> 
            <p id="gate_code" class="long-text" style="color: #ddc15c; font-size: var(--font-secondary-size); "><?= htmlspecialchars($gateCode) ?></p> 
        </span>
    </div>
    <div class="d-flex flex-column gap-2" style="margin-top: 1rem;">
        <p style="font-size: var(--font-tertiary-size);">STUDENT NAME</p>
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
    <div class="d-flex flex-column gap-2" style="margin-top: 1rem;">
        <p style="font-size: var(--font-tertiary-size);">STUDENT NO.</p>
        <input type="text" id="student_no" class="form-control" placeholder="2023102ABC" style="width: 100%;" require>
    </div>
    <div>
        <p style="font-size: var(--font-tertiary-size); color: #989898;">Please double check your name before clicking the check-in button.</p>
        <button class="btn primaryColor" id="check_in_button" style="width: 100%; margin-top: 1rem; background-color: var(--primary-color); color: white;">Check In</button>
    </div>
</div>

 