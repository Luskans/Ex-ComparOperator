<?php include('./Template/template_header.php'); ?>

<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/Destination.php');
session_start();


$manager = new Manager($db);

////// ON CHANGE L'AFFICHAGE DES DESTINATION EN FONCTION DES FILTRES DE RECHERCHE
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
?>

<main class="destinations">
    <div class="container destinationCards d-flex flex-wrap justify-content-center gap-3">
        
        <!----- BANNER ----->
        <div class="banner mb-3">
            <img class="position-end" src="./Utilities/Images/destinations.jpg">
            <div class="d-flex justify-content-center align-items-center">
                <h2>Destinations</h2>
            </div>
        </div>
        
        <?php foreach ($destinationsData as $destinationData) {
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
    </div>
</main>

<script src="./Utilities/Js/index.js"></script>
<?php include('./Template/template_footer.php'); ?>