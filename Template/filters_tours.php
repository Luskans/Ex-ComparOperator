<div class="container d-flex flex-wrap align-items-center justify-content-center p-2 gap-2">

    <!------- On change l'aspect du bouton score en fonction de l'ordre choisi ------->  
    <?php if (isset($_GET['score']) && $_GET['score'] === 'down') { ?>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Note</button>
    <?php } elseif (isset($_GET['score']) && $_GET['score'] === 'up') { ?>
        <div class="dropup">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Note</button>
    <?php } else { ?>
        <div class="dropdown">
            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">Note</button>
        <?php } ?>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&score=up">Croissant</a></li>
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&score=down">Décroissant</a></li>
            </ul>
        </div>
    
    <!------- On change l'aspect du bouton price en fonction de l'ordre choisi ------->  
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
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&price=up">Croissant</a></li>
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&price=down">Décroissant</a></li>
            </ul>
        </div>

    <!------- On change l'aspect du bouton commentaire en fonction de l'ordre choisi ------->  
    <?php if (isset($_GET['review']) && $_GET['review'] === 'down') { ?>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Commentaire</button>
    <?php } elseif (isset($_GET['review']) && $_GET['review'] === 'up') { ?>
        <div class="dropup">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Commentaire</button>
    <?php } else { ?>
        <div class="dropdown">
            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">Commentaire</button>
        <?php } ?>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&review=up">Croissant</a></li>
                <li><a class="dropdown-item" href="./tours.php?<?= $_SESSION['operatorPage'] ?>&review=down">Décroissant</a></li>
            </ul>
        </div>
        
    <!------- Barre de recherche -------> 
    <!-- <form action="./tours.php?<?= $_SESSION['operatorPage'] ?>&review=down" method="get" class="search d-flex" role="search">
        <input name="search"  class="search__bar form-control me-2" placeholder="Rechercher...">
        <button class="btn btn-outline-light" type="submit">Go</button>
    </form> -->
    <div class="d-flex">
        <input class="search__bar form-control me-2" placeholder="Rechercher...">
        <button class="btn btn-outline-light">Go</button>
    </div>
</div>