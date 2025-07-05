<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Profile</title>
	<style>
img {
    width: 300px;
    height: 300px;
    object-fit: cover; /* zooms/crops to fit without stretching */
    border-radius: 50%; /* makes it a circle */
    border: 2px solid #ccc; /* optional */
}

body{
	display: flex;
	flex-direction: column;
	align-content: center;
	align-items: center;
	font-size: 25px;
	background-image: url('back.jpg');
	background-size: 100vw 100vh;
    overflow-x: hidden;
}

h1{
	text-align: right;
}


</style>

</head>
<body>

<?php
// Get the username from URL
if (isset($_GET['user'])) {
    $name = $_GET['user'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL to get user
    $sql = "SELECT * FROM accounts WHERE name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user is found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        echo "
    <div style='margin-left: -60vw;'>
        <h1 style='text-align: left; position:absolute; top: -2vh; left: 20px'>User</h1>

    </div>
     <hr style='width: 100%; border: 1px solid black; position:absolute; top: 10vh; '>
";
       

        // Display image
        echo "<img src='" . htmlspecialchars($user['image']) . "' alt='User Image' width='150' style='position:absolute; top: 20vh;'>";
        echo "<p style='text-align: right; position:absolute; top: 56vh; left: 56vw;'>Welcome, </br> <strong>" . htmlspecialchars($user['name']) . "</strong></p>";
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No user specified.";
}
?>


</body>
</html>
