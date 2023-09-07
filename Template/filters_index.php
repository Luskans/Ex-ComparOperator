<div class="container d-flex align-items-center justify-content-center p-2 gap-2">
    
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