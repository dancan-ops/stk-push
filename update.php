<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$username = htmlspecialchars($_SESSION['username']);
?>

<?php
$conn = new mysqli("localhost", "root", "", "users");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $speed = $_POST['speed'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE plans SET speed=?, duration_minutes=?, price=? WHERE plan_id=?");

    $stmt->bind_param("sidi", $speed, $duration, $price, $id);
    $stmt->execute();

    echo "Plan updated.";
    $stmt->close();
}

$conn->close();
?>