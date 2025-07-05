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
    <title>Accounts</title>
    <link rel="stylesheet" type="text/css" href="accounts.css">

    <style>
        footer{
            position: absolute;
            top: 92vh;
            left: 84vw;
            color: whitesmoke;
        }
    </style>
</head>
<body>
   
    <button id="menu-btn">☰ Menu</button>

    <!-- Use hidden input if needed by JS -->
    <input type="hidden" id="username" value="<?php echo $username; ?>">

    <div id="page">
        <nav id="sidebar">
            <ul>
                <li><img src="user-solid.svg" alt="company logo" width="200px" ><br><br><p>mostly functional.org</p></li>
                <li><a href="#" id="usersLink" class="sidebar-link">Users</a></li>
                <li><a href="bundles.php" target="content-frame" class="sidebar-link">Bundles</a></li>
                <li><a href="transactions.html" target="content-frame" class="sidebar-link">Transactions</a></li>
                <li><a href="chats.html" target="content-frame" class="sidebar-link">Chats</a></li>
            </ul>
        </nav>

        <div id="content">
            <iframe name="content-frame" id="content-frame" src="" frameborder="0"></iframe>
        </div>
    </div>

    <script src="script.js"></script>

   
<footer>Mostlyfunctional.org</footer>

</body>
</html>
