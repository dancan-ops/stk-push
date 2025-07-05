<?php
session_start();

$conn = new mysqli("localhost", "root", "", "users");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $stmt = $conn->prepare("SELECT password FROM accounts WHERE name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $stored_hash = $user['password'];

            if (password_verify($password, $stored_hash)) {
               
                $_SESSION['username'] = $username;
                header("Location: accounts.php");
                exit;
            } else {
                echo "<p style='color:red'>❌ Wrong password.</p>";
            }
        } else {
            echo "<p style='color:red'>⚠️ User not found.</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color:red'>Please enter username and password.</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Into Accounts</title>
    <style>
        body{
            background-image: url('back.jpg');
            background-size: 100% 100vh;
            display: flex;
            flex-direction: column;
            align-content: center;
            align-items: center;
            font-size: 20px;
        }

        footer{
            position: absolute;
            top: 92vh;
            left: 88vw;
            color: whitesmoke;
        }

        fieldset{
            padding-top: 50px;
            padding-bottom: 50px;
        }

        button{
          width: 96%;
          height: 4vh;
          background-color: royalblue;
          border: none;
          color: white;
        }
    </style>
</head>
<body>
    <h1>lifetime</h1>
    <h2>Login</h2>
    <fieldset>
    <form action="login.php" method="POST">
        <div>
          <label>Username:</label><br>
        <input type="text" name="username" required><br>  
        </div><br>
        
        <div>
          <label>Password:</label><br>
        <input type="password" name="password" required><br>  
        </div><br>
        
        <button type="submit">Login</button>
        <p>do not have an account?<a href="signin.php">sign in</a>  instead</p>

    </form>
</fieldset>
    <footer>Mostlyfunctional.org</footer>
</body>
</html>
