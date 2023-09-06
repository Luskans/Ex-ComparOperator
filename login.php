<?php

require_once('./Utilities/Config/db.php');
require_once('./Utilities/Config/autoload.php');
require_once('./Model/Repository/Manager.php');




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once "db.php"; // Подключение к базе данных

    // Получение хеша пароля из базы данных
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Вход выполнен успешно, устанавливаем флаг авторизации
        $_SESSION["user_id"] = $user["id"];
        header("Location: admin.php");
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
    <title>Вход</title>
</head>
<body>
    <h2>Вход</h2>
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





