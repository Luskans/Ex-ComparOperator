<?php
session_start();


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord administratif</title>
</head>
<body>
    <h2>Tableau de bord administratif</h2>
    <ul>
        <li><a href="admin_new_operator.php">Ajouter un voyagiste</a></li>
        <li><a href="admin_edit_operator.php">Modifier un voyagiste</a></li>
        <li><a href="admin_delete_operator.php">Retirer un voyagiste</a></li>
        <li><a href="../logout.php">LOGOUT</a></li>
    </ul>
</body>
</html>