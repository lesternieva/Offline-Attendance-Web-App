<?php

header('Content-Type: application/json');
include 'connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$studentName = trim($data['student_name'] ?? '');
$gateCode = trim($data['gate_code'] ?? '');
/* $schedule_id = trim($data['schedule_id'] ?? ''); */
/* $ipAddress = $_SERVER['REMOTE_ADDR']; */

if($studentName === '' || $gateCode ==='') {
    echo json_encode(['success' => false, 'message' => 'Missing required info.']);
    exit;
}

// look up the student's ID from their name
$stmt = $conn->prepare("SELECT id FROM student WHERE student_name = ? AND status = 'active'");
$stmt->execute([$studentName]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$student) {
    echo json_encode(['success' => false, 'message' => 'Student not found or inactive.']);
    exit;
}

$studentID = $student['id'];

//check if IP address is already in the database for the same schedule
/* $stmt = $conn->prepare("SELECT id FROM attendance WHERE ip_address = ? AND gate_code = ?");
$stmt->execute([$ipAddress, $gateCode]);
if($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'This IP address has already been used for check-in.']);
    exit;
} */

// check if the student has already checked in for the same schedule
$stmt = $conn->prepare("SELECT id FROM attendance WHERE student_id = ? AND gate_code = ? AND DATE(time_in) = CURDATE()");
$stmt->execute([$studentID, $gateCode]);
if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'This student has already been checked in.']);
    exit;
}

// fetch the current date and time to determine the current course schedule for insert
$sql = "SELECT id FROM schedules
            WHERE day_of_week = ?
            AND ? BETWEEN start_time AND end_time";

    $schedID = $conn->prepare($sql);
    date_default_timezone_set('Asia/Manila');
    $today = date("l"); 
    $schedID->execute([$today, date("H:i:s")]);
    $schedule = $schedID->fetch(PDO::FETCH_ASSOC);

// check if there's no ongoing class -- uncomment when deployed
/* if (!$schedule) {
    echo json_encode(['success' => false, 'message' => 'No active schedule found for this time.']);
    exit;
} */

    $currentActiveSched = 3/* $schedule['id'] -- uncomment  */;

$stmt = $conn->prepare("INSERT INTO attendance (time_in, gate_code, sched_id, student_id) 
                        VALUES (NOW(), ?, ?, ?)");
$stmt->execute([$gateCode, $currentActiveSched, $studentID]);

echo json_encode(['success' => true, 'message' => 'Check-in successful.']);


?>