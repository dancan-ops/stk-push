<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>bundle setting</title>
	<style>
		#addBoxBundle{
			display: flex;
			flex-direction: column;
			align-items: center;
			align-content: center;
			width: 30vw;
			aspect-ratio: 1/1;
			box-shadow: 16px 12px 4px rgba(0, 0, 0, 0.3);
			padding: 3vw;
			align-items: center;
			align-content: center;
			background-color: white;
			margin: 2vw;
		}

		#add{
			background-color: #145EA3;
			border: none;
			width: 6vw;
			height: 4vh;
			color: white;
			
		}


		.plan-box {
			display: flex;
			flex-direction: column;
			align-items: center;
			align-content: center;
		  background-color: white;
		  width: 20vw;
		  aspect-ratio: 1/1;
		  padding: 3vw;
		  transition: transform 0.2s ease;
		  margin: 16px;
		  box-shadow: 16px 12px 4px rgba(0, 0, 0, 0.3);
		}

		.plan-box:hover {
		  transform: translateY(-8px);
		}

		.plan-box small{
			margin-top: 4vh;
			margin-left: -12vw;
		}
		
		.plan-box h2{
			 text-align: center;
			color: #1889F5;
		}

		.plan-box p{
			margin-left: 12vw ;
		
		}

		.plan-box button{
			background-color: #145EA3;
			border: none;
			margin-left: 12VW;
			width: 8vw;
			height: 4vh;
			color: white;
			border-radius: 4px;
		} 

		.plan-container {
			  display: flex;
			  overflow-x: auto;        /* allow horizontal scroll */
			  scroll-behavior: smooth; /* optional, for smooth effect */
			  gap: 20px;
			  padding: 10px;
			  -ms-overflow-style: none;  /* hide scrollbar in IE/Edge */
			  scrollbar-width: none;     /* hide scrollbar in Firefox */
		}

		.plan-container::-webkit-scrollbar {
			 display: none;             /* hide scrollbar in Chrome/Safari */
		}

		#edit{
			background-color: none;
			background:none;
			margin-left: 20vw;
			 width:12px;
			 margin-top: 8px;
			 cursor: pointer;
		}

	</style>
</head>
<body>
	<h1>bundle</h1>
	<hr>

	<div class="plan-container ">

	<div id="addBoxBundle">
		<form method="POST" action="">

			<label>speed</label><br>
			<input type="text" name="speed" placeholder="mbps" required><br><br>

			<label>duration</label><br>
			<input type="number" name="duration" placeholder="period" required><br><br>

			<label>amount</label><br>
			<input type="number" name="price" placeholder="amount" required><br><br>


			<input type="submit" value="add bundle" id="add">
		</form>
	</div>

	<?php

// 1. Connect to the database
$conn = new mysqli("localhost", "root", "", "users");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 3. Get values from the form
    $speed = $_POST['speed'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // 4. Prepare the SQL statement
    $sql = "INSERT INTO plans (speed, duration_minutes, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sid", $speed, $duration, $price);  // s = string, i = int, d = decimal
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "✅ Bundle added successfully.";
        } else {
            echo "❌ Failed to add bundle.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// 5. Close connection
$conn->close();

 if (!empty($message)) echo "<p>$message</p>"; 



 
$conn = new mysqli("localhost", "root", "", "users");

// Fetch all plans
$sql = "SELECT * FROM plans";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
    	 $id = $row['plan_id'];
        echo "
        <div class='plan-box' id='plan-$id'>
        <div style='display:flex'>
        <button onclick='editPlan($id, \"{$row['speed']}\", {$row['duration_minutes']}, {$row['price']})' id='edit'>
        <img src='edit.svg'>
    </button>

  <form method='POST' action='delete.php' onsubmit='return confirm(\"Delete this bundle?\")'>
    <input type='hidden' name='id' value='$id'>
    <button type='submit' style='background: none; border: none; cursor: pointer; margin-top: 10px; width:10px;'>
  <img src='delete.svg' alt='Delete' style='width: 24px; height: 24px; margin-left: -12vw'>
</button>

  </form>
  </div>
    

    <small>{$row['speed']}mbps</small>
    <h2>{$row['duration_minutes']} hours</h2>
    <p>{$row['price']} ksh</p>
    <button>buy</button>
</div>

        ";
    }
  
} else {
    echo "<p>No bundles found.</p>";
}

$conn->close();
?>

</div>

<script>
function editPlan(id, speed, duration, price) {
    const box = document.getElementById(`plan-${id}`);
    box.innerHTML = `
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="${id}">
            
            <label>Speed:</label><br>
            <input type="text" name="speed" value="${speed}" required><br><br>

            <label>Duration (mins):</label><br>
            <input type="number" name="duration" value="${duration}" required><br><br>

            <label>Price (Ksh):</label><br>
            <input type="number" name="price" value="${price}" required><br><br>

            <input type="submit" value="Save">
        </form>
    `;
}

</script>




</body>
</html>