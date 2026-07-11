<?php
    $studentStmt = $conn->query("SELECT id, student_name FROM student WHERE status = 'active' ORDER BY student_name ASC");
    if (!$studentStmt) {
        print_r($conn->errorInfo());
    }
?>

<div id="" class="reminders">
    <p style="font-size-: var(--font-tertiary-size);">Download your DTR here for every subject, just for transparency.</p>
</div>
<div class="MyCard report">
    
    <div class="d-flex flex-column gap-2" >
        <p style="font-size: var(--font-tertiary-size);">STUDENT NO.</p>
        <input type="text" id="student_no_for_dtr" class="form-control" placeholder="2023XXXXXX" style="width: 100%;" require>
    </div>
    <div class="d-flex flex-column ">
        <p style="font-size: var(--font-tertiary-size);">DATE RANGE</p>
        <div class="d-flex flex-column mb-1">
            <div class="flex-grow-1 mb-0">
                <label style="font-size: var(--font-tertiary-size); color: #666;">From</label>
                <input type="date" id="date_from" class="form-control" style="width: 100%;" min="2026-07-06" required>
            </div>
            <div class="flex-grow-1 mb-0">
                <label style="font-size: var(--font-tertiary-size); color: #666;">To</label>
                <input type="date" id="date_to" class="form-control" style="width: 100%;" min="2026-07-06" required>
            </div>
        </div>
    </div>
    <div>
        <p style="font-size: var(--font-tertiary-size); color: #989898;">Please make sure everything is correct.</p>
        <button class="btn" id="export_csv_button" style="width: 100%; margin-top: 1rem; background-color: var(--primary-color); color: white;">Download CSV File</button>
    </div>
</div>

<div class="MyCard">

</div>