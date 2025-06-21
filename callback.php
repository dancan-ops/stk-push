<?php
// Get the raw POST data from Safaricom
$data = file_get_contents('php://input');

// Convert JSON string to PHP array
$log = json_decode($data, true);

// Save it to a log file for now
file_put_contents('mpesa_log.txt', print_r($log, true), FILE_APPEND);

// Optionally, send a response back to Safaricom
echo json_encode(["ResultCode" => 0, "ResultDesc" => "Received successfully"]);
?>

