<?php include('./Template/template_header.php'); ?>

<?php

// var_dump($_SERVER['DOCUMENT_ROOT']);
// var_dump(__DIR__);
// die();
require_once(__DIR__ . '/Utilities/Config/db.php');
require_once(__DIR__ . '/Utilities/Config/autoload.php');
// require_once(__DIR__ . '/Utilities/Config/db.php');
// require_once('./Utilities/Config/db.php');
// require_once('./Utilities/Config/autoload.php');
session_start();

$manager = new Manager($db);

////// ON CHANGE L'AFFICHAGE DES DESTINATIONS EN FONCTION DES FILTRES DE RECHERCHE
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $destinationsData = $manager->getDestinationsBySearch($search);
} elseif (isset($_GET['price']) && $_GET['price'] === 'up') {
    $destinationsData = $manager->getDestinationsByPriceUp();
} elseif (isset($_GET['price']) && $_GET['price'] === 'down') {
    $destinationsData = $manager->getDestinationsByPriceDown();
} else {
    $destinationsData = $manager->getAllDestinations();
}

////// ON SELECTIONNE 3 OPERATOTS PREMIUM AU HAZARD
$operatorsData = $manager->getThreeRandomPremiumOperators();
?>

<main class="">

    <!--------- BANNER --------->
    <!-- <section class="container p-0">
        <div class="banner">
            <img src="./Utilities/Images/destinations.jpg">
            <div class="d-flex justify-content-center align-items-center">
                <h2>Destinations</h2>
            </div>
        </div>
    </section> -->

    <!--------- FILTERS --------->
    <aside class="filters mb-5">
        <?php include('./Template/filters_index.php'); ?>
    </aside>

    <!--------- CAROUSEL --------->
    <section class="carousel carousel-dark mb-5">
        <div class="container">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <?php include('./Template/display_carousel.php'); ?>
                    <!-- <div class="carousel-item active">
                        <img src="..." class="d-block w-100" alt="...">
                        <div class="test1"></div>
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                        <div class="test2"></div>
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                        <div class="test3"></div>
                    </div> -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!--------- DESTINATIONS --------->
    <section class="destinations py-5">
        <div class="container destinationCards d-flex flex-wrap justify-content-center gap-3">
            
            <!-- --- BANNER ---
            <div class="banner mb-3">
                <img class="position-end" src="./Utilities/Images/destinations.jpg">
                <div class="d-flex justify-content-center align-items-center">
                    <h2>Destinations</h2>
                </div>
            </div> -->
            
            <?php
            $totalDestinations = 0; // Used to calculate display frequency of pubs
            $pubsFrequency = rand(4, 6); // Display a pub every 4 to 6 destinations
            foreach ($destinationsData as $destinationData) {
                if ($totalDestinations != 0 && $totalDestinations % $pubsFrequency === 0) { ?>
                    <div class="destinationCard d-flex justify-content-center align-items-center">
                        <p>PUB</p>
                    </div>
                <?php } else {

                $destination = new Destination($destinationData); ?>
                <a href="./tours.php?destinationLocation=<?= $destination->getLocation() ?>&destinationImage=<?= $destination->getImage() ?>">
                    <div class="destinationCard">
                        <div class="destinationCard__image">
                            <img src="<?= $destination->getImage() ?>" alt="<?= $destination->getLocation() ?>">
                        </div>
                        <div class="destinationCard__text d-flex justify-content-around align-items-center">
                            <h3 class="destinationCard__location">
                                <?= $destination->getLocation(); ?>
                            </h3>
                            <p class="destinationCard__price">
                                <?= $destination->getPrice(); ?> €
                            </p>
                        </div>
                        <!-- <form action="./tours.php" method="get">
                            <input type="hidden" name="destinationLocation" value="<?= $destination->getLocation() ?>">
                            <input type="hidden" name="destinationImage" value="<?= $destination->getImage() ?>">
                            <button type="submit">Voir les tours</button>
                        </form> -->
                    </div>
                </a>
                <?php } ?>
                <?php $totalDestinations++;?>
            <?php } ?>
        </div>
    </section>

</main>
<script src="./Utilities/Js/index.js"></script>
<?php include('./Template/template_footer.php'); ?>