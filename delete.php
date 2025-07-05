<?php

session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$username = htmlspecialchars($_SESSION['username']);

$conn = new mysqli("localhost", "root", "", "users");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM plans WHERE plan_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "✅ Plan deleted.";
    } else {
        echo "❌ Could not delete plan.";
    }

    $stmt->close();
}

// Redirect back to the main page
header("Location: bundles.php");
exit;
?>
