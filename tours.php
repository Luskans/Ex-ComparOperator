<?php include('./Template/template_header.php'); ?>

<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/TourOperator.php');
require_once('./Model/Entity/Destination.php');
require_once('./Model/Entity/Review.php');
require_once('./Model/Entity/Score.php');
require_once('./Model/Entity/Author.php');
require_once('./Model/Entity/Certificate.php');
require_once('./Template/filters_functions.php');
session_start();


///// ON MET EN SESSION LES PARAMETRES DE LA PAGE POUR REVENIR DESSUS APRES COMMENTAIRES, SCORES OU FILTRES
$_SESSION['operatorPage'] = 'destinationLocation=' . $_GET['destinationLocation'] . '&' . 'destinationImage=' . $_GET['destinationImage'];

$manager = new Manager($db); ?>

<main>
    <!-- ------- BANNER --------->
    <!-- <section class="container p-0">
    <?php if (isset($_GET['destinationImage'])) { ?>
        <div class="banner">
            <img src="<?= $_GET['destinationImage'] ?>">
            <div class="d-flex justify-content-center align-items-center">
                <h2><?= $_GET['destinationLocation'] ?></h2>
            </div>
        </div>
    <?php } ?>
    </section> -->

    <!--------- FILTERS --------->
    <aside class="filters mb-5">
        <?php include('./Template/filters_tours.php'); ?>
    </aside>

    <section class="container operatorCards d-flex flex-wrap justify-content-center gap-3 mb-5">

        <?php 
        ////// RECUPERE LES DESTINATIONS SELON LE NOM
        if (isset($_GET['destinationLocation'])) {
            $destinationsByLocationData = $manager->getDestinationsByLocation($_GET['destinationLocation']);
        } else {
            header('location: ./index.php');
        }

        ////// RECUPERE LES OPERATORS SELON LA DESTINATION ET LES FILTRES
        $operatorsData = [];
        // foreach ($destinationsByLocationData as $destinationByLocationData) {
        //     if (isset($_GET['price']) && ($_GET['price'] === 'up')) {

        //         // $operatorsData = $manager->getOpByDestIdByPriceUp($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['price']) && ($_GET['price'] === 'down')) {

        //         // $operatorsData = $manager->getOpByDestIdByPriceDown($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['score']) && ($_GET['score'] === 'up')) {

        //         // $operatorsData = $manager->getOpByDestIdByScoreUp($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['score']) && ($_GET['score'] === 'down')) {

        //         // $operatorsData = $manager->getOpByDestIdByScoreDown($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['review']) && ($_GET['review'] === 'up')) {

        //         $operatorsData = $manager->getOpByDestIdByReviewUp($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['review']) && ($_GET['review'] === 'down')) {

        //         // $operatorsData = $manager->getOpByDestIdByReviewDown($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');

        //     } elseif (isset($_GET['search']) && !empty($_GET['search'])) {

        //         $search = $_GET['search'];
        //         $operatorsData = $manager->getOpByDestIdBySearch($destinationByLocationData['tour_operator_id'], $search);
        //         include('./Template/display_operators.php');

        //     } else {

        //         $operatorsData = $manager->getOperatorByDestinationId($destinationByLocationData['tour_operator_id']);
        //         include('./Template/display_operators.php');
        //     }   
        // } ?>

        <?php
        foreach ($destinationsByLocationData as $destinationByLocationData) {
        
            if (isset($_GET['search']) && !empty($_GET['search'])) {

                $search = $_GET['search'];
                $operatorsData = $manager->getOpByDestIdBySearch($destinationByLocationData['tour_operator_id'], $search);
                include('./Template/display_operators2.php');

            } else {
                
                $operatorsData = $manager->getOperatorByDestinationId($destinationByLocationData['tour_operator_id']);
                include('./Template/display_operators2.php');
            }   
        } ?>

    </section>
</main>

<script src="./Utilities/Js/tours.js"></script>
<?php include('./Template/template_footer.php'); ?>
