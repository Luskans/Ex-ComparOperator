<?php
require_once('../Utilities/Config/db.php');
require_once('../Model/Repository/Manager.php');
session_start();

$manager = new Manager($db);

// ON VERIFIE POUR VOIR SI LE NOM DE L'AUTEUR EST DEJA EN DATABASE
if (isset($_POST['name'])) {
    $count = $manager->checkAuthor($_POST['name']) + $manager->checkAuthor(strtolower($_POST['name'])) + $manager->checkAuthor(strtoupper($_POST['name']));

    if ($count === 0) {

        if (isset($_POST['message']) && isset($_POST['operatorId'])) {
            $manager->createReview(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['message']), $_POST['operatorId']);
        }
        header('location: ../tours.php?' . $_SESSION['operatorPage']);

    } else {
        header('location: ../tours.php?' . $_SESSION['operatorPage'] . '&error=nau');
    }
}