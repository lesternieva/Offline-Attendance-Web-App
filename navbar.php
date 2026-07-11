<!-- 
    page is indicated here (in the achor tag)
-->

<header class="header-grid">
    <div class="header-title ">
        <h3 id="labelClock" style="color: var(--tertiary-color); font-size: var(--font-secondary-size);">BSM CS 4A - Attendance</h3>
        <h1 id="rollCall" style="color: var(--secondary-color)">Roll Call</h1>
        <p><?php echo $course_code . ' - ' . $course_name; ?> </p>
    </div>
    <div class="header-time">
        <h3 id="labelClock" style="color: var(--tertiary-color); font-size: var(--font-secondary-size);">Current Datetime</h3>
        <h1 id="clock"></h1>
        <p id="date"></p>
    </div>
</header>

<script>
    const currentSubject = "<?php echo htmlspecialchars($course_code) ?>";
</script>

<div class="navbar-grid gap-3" >
    <div class="<?= ($page == 'check-in') ? 'active-anchor' : ''?>">
    <a class="text-decoration-none" style="color: var(--primary-color)" href="index.php?page=check-in">Check In</a>
    </div>
    <div class="<?= ($page == 'dashboard') ? 'active-anchor' : ''?>">
        <a class="text-decoration-none <?= ($page == 'dashboard') ? 'active-anchor' : ''?>" style="color: var(--primary-color)" href="index.php?page=dashboard">Dashboard</a>
    </div>
    <div class="<?= ($page == 'register') ? 'active-anchor' : ''?>">
        <a class="text-decoration-none <?= ($page == 'register') ? 'active-anchor' : ''?>" style="color: var(--primary-color)" href="index.php?page=register">Register</a>
    </div>
    <div class="<?= ($page == 'report') ? 'active-anchor' : ''?>">
        <a class="text-decoration-none <?= ($page == 'report') ? 'active-anchor' : ''?>" style="color: var(--primary-color)" href="index.php?page=report">Report</a>
    </div>
    
    
</div>