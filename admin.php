<?php

require_once('./Utilities/Config/db.php');
require_once('./Utilities/Config/autoload.php');
require_once('./Model/Repository/Manager.php');
require_once('./admin/admin_dashboard.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = 'admin';
    $password = 'adminPassword';
    if($_POST['username'] === $username && $_POST['password'] === $password){
        
        $_SESSION['admin'] = 1;
        header("Location:./admin/admin_dashboard.php");
        exit;
    }
    
}

if(!empty($_SESSION['admin']) && $_SESSION['admin'] === 1){

    header("Location:./admin/admin_dashboard.php");
        exit;
} else {

    include_once('./login.php');

}

?>











