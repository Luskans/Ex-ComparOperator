<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Utilities/Css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>

    <!-- <header class="header mb-5">
        <div class="header__logo"><img src=""></div>
        <div class="container">
            <form action="./tours.php" method="get" class="d-flex" role="search">
                <input name="search"  class="search__bar form-control me-2" placeholder="Rechercher...">
                <button class="btn btn-outline-light" type="submit">Go</button>
            </form>
        </div>
    </header> -->

    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="header__logo">
                <img src="./Utilities/Images/logo.png">
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-end gap-2">
                <!------- On change l'aspect du bouton price en fonction de l'odre choisi ------->
                
            <?php if (isset($_GET['price']) && $_GET['price'] === 'down') { ?>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Prix</button>
            <?php } elseif (isset($_GET['price']) && $_GET['price'] === 'up') { ?>
                <div class="dropup">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Prix</button>
            <?php } else { ?>
                <div class="dropdown">
                    <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">Prix</button>
                <?php } ?>
        
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./index.php?price=up">Croissant</a></li>
                        <li><a class="dropdown-item" href="./index.php?price=down">Décroissant</a></li>
                    </ul>
                </div>
                
                <form action="./index.php" method="get" class="search d-flex" role="search">
                    <input name="search"  class="search__bar form-control me-2" placeholder="Rechercher...">
                    <button class="btn btn-outline-light" type="submit">Go</button>
                </form>
            </div>
        </div>
    </header>