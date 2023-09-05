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
?>

<main>
    <div class="container operatorCards d-flex flex-wrap gap-3">

<?php
$manager = new Manager($db);

if (isset($_GET['operatorId'])) {
    $operatorsData = $manager->getOperatorByDestinationId($_GET['operatorId']);
}

foreach ($operatorsData as $operatorData) {
    
    $destinationsData = $manager->getDestinationsByOperatorId($operatorData['id']);
    $destinationsCollection = [];
    foreach ($destinationsData as $destinationData) {
        $destinationsCollection[] = new Destination($destinationData);
    }

    $reviewsData = $manager->getReviewsByOperatorId($operatorData['id']);
    $reviewsCollection = [];
    foreach ($reviewsData as $reviewData) {
        $authorData = $manager->getAuthorByReviewId($reviewData['author_id']);
        $reviewsCollection[] = new Review($reviewData, new Author($authorData));
    }

    $scoresData = $manager->getScoresByOperatorId($operatorData['id']);
    $scoresCollection = [];
    foreach ($scoresData as $scoreData) {
        $authorData2 = $manager->getAuthorByScoreId($scoreData['author_id']);
        $scoresCollection[] = new Score($scoreData, new Author($authorData2));
    }

    $certificateData = $manager->getCertificateByOperatorId($operatorData['id']);
    $certificate = new Certificate($certificateData);

    $operator = new TourOperator($operatorData, $destinationsCollection, $reviewsCollection, $scoresCollection, $certificate); ?>

    
        <div class="operatorCard mb-5">
            <h3><?= $operator->getName(); ?> :</h3>

            <p>Itinéraires :</p>

            <?php $totalPrice = 0 ?>
            <?php foreach ($operator->getDestinations() as $stage) { ?>
                <p><?= $stage->getLocation(); ?> <?= $stage->getPrice(); ?> €</p>
                <?php $totalPrice += $stage->getPrice() ?>
            <?php } ?>

            <p>Prix total : <?= $totalPrice ?> €</p> 

            <?php $totalScore = 0 ?>
            <?php $scoreCount = 0 ?>
            <?php foreach ($operator->getScores() as $score) { ?>
                <?php $totalScore += $score->getValue(); ?>
                <?php $scoreCount ++; ?>
            <?php } ?>

            <p>Score : <?= $totalScore / $scoreCount ?></p>

            <p>Commentaires :</p>

            <?php foreach ($operator->getReviews() as $review) { ?>
                <p><?= $review->getMessage(); ?></p>
                <p><?= $review->getAuthor()->getName(); ?></p>
            <?php } ?>
        </div>
<?php } ?>

    </div>
</main>

<?php include('./Template/template_footer.php'); ?>