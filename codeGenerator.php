<?php

function gateCodeGenerator($course_code) {
    $day = strtoupper(date('D'));
    $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 3));
    return str_replace(' ', '', $course_code) . $day . $random;
}


const allowableCheckInMinutes = 60; // 1 hr 

define('GATE_CODE_INTERVAL_MINUTES', allowableCheckInMinutes);

function getGateCode($conn, $sched_id, $course_code){
    $stmt = $conn->prepare('SELECT code, generated_at FROM gate_codes
                            WHERE sched_id = ?
                            ORDER BY generated_at DESC LIMIT 1');

    $stmt->execute([$sched_id]);
    $existingCode = $stmt->fetch(PDO::FETCH_ASSOC);

    $intervalSeconds = GATE_CODE_INTERVAL_MINUTES * 60;

    if($existingCode) {
        $ageSeconds = time() - strtotime($existingCode['generated_at']);
        if ($ageSeconds < $intervalSeconds) {
            return $existingCode['code']; // still valid
        }
    }

    // but... if it is expired or does not exist yet -- make one then save
    $newCode = gateCodeGenerator($course_code);

    $insert = $conn->prepare("INSERT INTO gate_codes (sched_id, code, generated_at)
                              VALUES (?, ?, datetime('now'))");
    $insert->execute([$sched_id, $newCode]);

    return $newCode;
}
?>