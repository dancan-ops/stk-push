<?php
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'users');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($username);
    $hashed = $conn->real_escape_string($hashed);

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['user_image']['tmp_name'];
        $image_name = basename($_FILES['user_image']['name']);
        $upload_dir = "uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_path = $upload_dir . uniqid() . "_" . $image_name;

        if (!move_uploaded_file($image_tmp, $image_path)) {
            die("Image upload failed.");
        }
    } else {
        die("Image not uploaded.");
    }

    $sql = "INSERT INTO accounts (name, password, image) VALUES ('$username', '$hashed', '$image_path')";

    if ($conn->query($sql) === TRUE) {
       header("Location: accounts.php?user=" . urlencode($username));
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
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
            padding:50px;
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

    <h2>sign in</h2>

    <fieldset>

 <form method="POST" action="" enctype="multipart/form-data">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Upload Image</label><br>
    <input type="file" name="user_image" accept="image/*" required><br><br>

    <button type="submit">register</button>

    <p>already have an accaunt?<a href="login.php">log in</a> instead</p>
</form>
</fieldset>

<footer>Mostlyfunctional.org</footer>

</body>
</html>
