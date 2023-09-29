<?php

require_once('./Utilities/Config/db.php');
require_once('./Utilities/Config/autoload.php');
require_once('./Model/Repository/Manager.php');

session_start();



if (isset($_SESSION['admin'])&&
$_SESSION['admin'] ===1) {
    header("Location:./admin/admin_dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($_POST);

    $username = 'admin';
    $password = 'adminPassword';


    $manager = new Manager($db);

    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        
        $_SESSION["admin"] = 1;
        header("Location:./admin/admin_dashboard.php");
        exit;
    } else {
        $error_message = "Error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <h2>LOGIN</h2>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">NOM:</label>
        <input type="text" name="username" required><br>
        <label for="password">PASSWORD:</label>
        <input type="password" name="password" required><br>
        <button type="submit">LOGIN</button>
    </form>
</body>
</html>





