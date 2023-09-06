<?php

require_once('./Utilities/Config/db.php');
require_once('./Utilities/Config/autoload.php');
require_once('./Model/Repository/Manager.php');
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = 'admin';
    $password = 'adminPassword';
    if($_POST['username'] === $username && $_POST['password'] === $password){
        
        $_SESSION['admin'] = 1;
    }
    
}

if(!empty($_SESSION['admin']) && $_SESSION['admin'] === 1){

    ?> <div>hello admin</div> <?php


} else {

    include_once('./login.php');

}


?>











