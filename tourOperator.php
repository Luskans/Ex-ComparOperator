<?php include('./Template/template_header.php'); ?>

<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/Destination.php');
require_once('./Model/Entity/TourOperator.php');
require_once('./Model/Entity/Review.php');
require_once('./Model/Entity/Score.php');

$manager = new Manager($db);

if (!empty($_GET['tour_operator_id'])) {
    $operatorsData = $manager->getOperatorByDestination();

    foreach ($operatorsData as $operatorData) {
        $operator = new TourOperator($operatorData); ?>
            <div class="operatorCard">
                <div class="operatorCard__image">
                    <img src="#">
                </div>
                <h3 class="operatorCard__title">
                    <?= $operator->getName(); ?>
                </h3>
                <p class="operatorCard_score">
                    <?= $operator->getScore(); ?>
                </p>
                <p class="operatorCard__price">
                    <?= $_GET['price'] ?> €
                </p>
                <?php foreach ($operator->getReviews() as $review) {

                }
            </div>

            private int $id;
            private string $name;
            private string $link;
            private Certificate $certificate;
            private array $destinations;
            private array $reviews;
            private array $scores;
            private bool $isPremium;


        // $reviewDatas = $manager->getReviewByOperatorId($operator->getId());
        // foreach ($reviewDatas as $reviewData) {
        //     $review = new Review($reviewData);
        //     $authorData = $manager->getAuthorByReviewId($review->getAuthor_id()); 
        // }
        
        // $scoreDatas = $manager->getScoreByOperatorId($operator->getId());
        // foreach ($scoreDatas as $scoreData) {
        //     $score = new Score($scoreData);
        // }
    }
}

?>

<main class="destination mb-5">
    <div class="container destinationCards d-flex flex-wrap gap-3">

    </div>
</main>

<?php include('./Template/template_footer.php'); ?>