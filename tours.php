<?php include('./Template/template_header.php'); ?>

<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/Destination.php');
require_once('./Model/Entity/TourOperator.php');
require_once('./Model/Entity/Review.php');
require_once('./Model/Entity/Score.php');

$manager = new Manager($db);

if (!empty($_GET['destinationId'])) {
    $destinationData = $manager->getDestinationById($_GET['destinationId']);
    $destination = new Destination($destinationData);
    $operatorsData = $manager->getOperatorByDestination($destination);

    foreach ($operatorsData as $operatorData) {
        $operator = new TourOperator($operatorData); ?>
        <div class="container destinationCards d-flex flex-wrap gap-3">
            <div class="operatorCard mb-5">
                <div><img src="#"></div>

                <h3><?= $operator->getName(); ?> :</h3>

                <p>Itinéraires :</p>

                <?php $totalPrice = 0 ?>
                <?php foreach ($operator->getDestinations() as $stage) { ?>
                    <p><?= $stage->getLocation(); ?> <?= $stage->getPrice(); ?></p>
                    <?php $totalPrice += $stage->getPrice() ?>
                <?php } ?>

                <p>Prix total : <?= $totalPrice ?></p> 

                <?php $totalScore = 0 ?>
                <?php foreach ($operator->getScores() as $score) { ?>
                    <?php $totalScore += $score->getValue(); ?>
                <?php } ?>

                <p>Score : <?= $totalScore ?></p>

                <p>Commentaires :</p>

                <?php foreach ($operator->getReviews() as $review) { ?>
                    <p><?= $review->getMessage(); ?></p>
                    <p><?= $review->getAuthor(); ?></p>
                <?php } ?>
            </div>
        </div>
    <?php }
}?>



<?php
if (!empty($_GET['destinationName'])) {
    $destinationsByNameCollection = $manager->getDestinationsByName($_GET['destinationName']);
} 

$operatorsCollection = [];
foreach ($destinationsByNameCollection as $destinationByName) {
    $operator = $manager->getOperatorByDestination($destinationByName);
    $operatorsCollection[] = $operator;
}

foreach ($operatorsCollection as $operator) {
    // mettre tout le display, l'objet operator doit deja avoir tout
} ?>








<?php include('./Template/template_footer.php'); ?>