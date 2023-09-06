<?php
require_once('../Utilities/Config/db.php');
require_once('../Model/Repository/Manager.php');
session_start();

$manager = new Manager($db);

if (!empty($_POST['name'])) {
    $count = $manager->checkAuthor($_POST['name']) + $manager->checkAuthor(strtolower($_POST['name'])) + $manager->checkAuthor(strtoupper($_POST['name']));

    if ($count === 0) {
        
        if (isset($_POST['value']) && isset($_POST['operatorId'])) {
            $manager->createScore(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['value']), htmlspecialchars($_POST['operatorId']));
        }
        header('location: ../tours.php?' . $_SESSION['operatorPage']);

    } else {
        header('location: ../tours.php?' . $_SESSION['operatorPage'] . '&error=nau');
    }

} else {
    header('location: ../tours.php?' . $_SESSION['operatorPage'] . '&error=nm');
}