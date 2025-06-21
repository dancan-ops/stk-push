<?php
// For now, just log the callback data
$callbackJSONData = file_get_contents('php://input');
file_put_contents('callback_log.txt', $callbackJSONData);
?>
