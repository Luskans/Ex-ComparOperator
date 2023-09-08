<?php

$operators = [];
foreach ($operatorsData as $operatorData) {
    ////// RECUPERE LES DESTINATIONS SELON L'OPERATOR
    $destinationsData = $manager->getDestinationsByOperatorId($operatorData['id']);
    $destinationsCollection = [];
    foreach ($destinationsData as $destinationData) {
        $destinationsCollection[] = new Destination($destinationData);
    }

    ////// RECUPERE LES REVIEWS SELON L'OPERATOR
    $reviewsData = $manager->getReviewsByOperatorId($operatorData['id']);
    $reviewsCollection = [];
    foreach ($reviewsData as $reviewData) {
        ///// RECUPERE LES AUTHORS SELON LE REVIEW
        $authorData = $manager->getAuthorByReviewId($reviewData['author_id']);
        $reviewsCollection[] = new Review($reviewData, new Author($authorData));
    }

    ///// RECUPERE LES SCORES SELON L'OPERATOR
    $scoresData = $manager->getScoresByOperatorId($operatorData['id']);
    $scoresCollection = [];
    foreach ($scoresData as $scoreData) {
        ////// RECUPERE LES AUTHORS SELON LE SCORE
        $authorData2 = $manager->getAuthorByScoreId($scoreData['author_id']);
        $scoresCollection[] = new Score($scoreData, new Author($authorData2));
    }

    /////// RECUPERE LE CERTIFICATE SELON L'OPERATOR
    $certificateData = $manager->getCertificateByOperatorId($operatorData['id']);
    $certificate = new Certificate($certificateData);

    ////// CREE L'OPERATOR AVEC LES INFOS RECUPEREES
    $operator = new TourOperator($operatorData, $destinationsCollection, $reviewsCollection, $scoresCollection, $certificate);
    $operators[] = $operator;
} ?>

<?php
// var_dump($operators);
////// FILTRE DES OBJETS OPERATORS

if (isset($_GET['price']) && ($_GET['price'] === 'up')) {
    usort($operators, 'sortOperatorsByPriceUp');
} elseif (isset($_GET['price']) && ($_GET['price'] === 'down')) {
    usort($operators, 'sortOperatorsByPriceDown');
} elseif (isset($_GET['score']) && ($_GET['score'] === 'up')) {
    usort($operators, 'sortOperatorsByScoreUp');
} elseif (isset($_GET['score']) && ($_GET['score'] === 'down')) {
    usort($operators, 'sortOperatorsByScoreDown');
} elseif (isset($_GET['review']) && ($_GET['review'] === 'up')) {
    usort($operators, 'sortOperatorsByReviewUp');
} elseif (isset($_GET['review']) && ($_GET['review'] === 'down')) {
    usort($operators, 'sortOperatorsByReviewDown');
} else {

}
// var_dump($operators);

$totalOperators = 0; // Used to calculate display frequency of pubs
$pubsFrequency = rand(4, 6); // Display a pub every 4 to 6 operators
foreach ($operators as $operator) {

    if ($totalOperators != 0 && $totalOperators % $pubsFrequency === 0) { ?> <!-- PUB -->
        <div class="operatorCard d-flex justify-content-center align-items-center">
            <p>PUB</p>
        </div>
    <?php } else { ?>

        <!--------------- DISPLAY DES CARTES TOUR_OPERATOR--------------->
        <div class="operatorCard">
            <div class="operatorCard__title d-flex justify-content-between align-items-center pt-2 px-3">
                <?php if ($operator->getIsPremium()) { ?>
                    <div class="d-flex gap-2">
                        <svg width="40px" height="40px" viewBox="0 0 24 24">
                        <path d="M19.6872 14.0931L19.8706 12.3884C19.9684 11.4789 20.033 10.8783 19.9823 10.4999L20 10.5C20.8284 10.5 21.5 9.82843 21.5 9C21.5 8.17157 20.8284 7.5 20 7.5C19.1716 7.5 18.5 8.17157 18.5 9C18.5 9.37466 18.6374 9.71724 18.8645 9.98013C18.5384 10.1814 18.1122 10.606 17.4705 11.2451L17.4705 11.2451C16.9762 11.7375 16.729 11.9837 16.4533 12.0219C16.3005 12.043 16.1449 12.0213 16.0038 11.9592C15.7492 11.847 15.5794 11.5427 15.2399 10.934L13.4505 7.7254C13.241 7.34987 13.0657 7.03557 12.9077 6.78265C13.556 6.45187 14 5.77778 14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 5.77778 10.444 6.45187 11.0923 6.78265C10.9343 7.03559 10.759 7.34984 10.5495 7.7254L8.76006 10.934C8.42056 11.5427 8.25081 11.847 7.99621 11.9592C7.85514 12.0213 7.69947 12.043 7.5467 12.0219C7.27097 11.9837 7.02381 11.7375 6.5295 11.2451C5.88787 10.606 5.46156 10.1814 5.13553 9.98012C5.36264 9.71724 5.5 9.37466 5.5 9C5.5 8.17157 4.82843 7.5 4 7.5C3.17157 7.5 2.5 8.17157 2.5 9C2.5 9.82843 3.17157 10.5 4 10.5L4.01771 10.4999C3.96702 10.8783 4.03162 11.4789 4.12945 12.3884L4.3128 14.0931C4.41458 15.0393 4.49921 15.9396 4.60287 16.75H19.3971C19.5008 15.9396 19.5854 15.0393 19.6872 14.0931Z" fill="#fbc229"/>
                        <path d="M10.9121 21H13.0879C15.9239 21 17.3418 21 18.2879 20.1532C18.7009 19.7835 18.9623 19.1172 19.151 18.25H4.84896C5.03765 19.1172 5.29913 19.7835 5.71208 20.1532C6.65817 21 8.07613 21 10.9121 21Z" fill="#fbc229"/>
                        </svg>
                        <h3><?= $operator->getName(); ?></h3>
                    </div>
                <?php } else { ?>
                    <h3><?= $operator->getName(); ?></h3>
                <?php } ?>
                <?php $totalScore = 0 ?>
                <?php $scoreCount = 0 ?>
                <?php foreach ($operator->getScores() as $score) { ?>
                    <?php $totalScore += $score->getValue(); ?>
                    <?php $scoreCount ++; ?>
                <?php } ?>

                <?php if ($totalScore === 0) { ?>
                    <p class="score">0 ★</p>
                <?php } else { ?>
                    <p class="score"><?= number_format($totalScore / $scoreCount, 1) ?> ★</p>
                <?php } ?>
            </div>

            <?php if ($operator->getIsPremium()) { ?>
                <div class="operatorCard__link">
                    <a href="<?= $operator->getLink() ?>" target="blank"><p><?= $operator->getLink()?></p></a>
                </div>
            <?php } else { ?>
                <div class="operatorCard__link operatorCard__link--empty">
                    
                </div>
            <?php } ?>

            <?php $totalPrice = 0 ?>
            <ul class="operatorCard__stages">
            <?php foreach ($operator->getDestinations() as $stage) { ?>
                <li><?= $stage->getLocation(); ?> <?= $stage->getPrice(); ?> €</li>
                <?php $totalPrice += $stage->getPrice() ?>
            <?php } ?>
            </ul>

            <p class="operatorCard__total">Prix total : <?= $totalPrice ?> €</p> 

            <form class="operatorCard__form" action="./Process/add_commentary.php" method="post">
                <input type="hidden" name="operatorId" value="<?= $operator->getId() ?>">
                <textarea name="message" placeholder="Ecrivez votre commentaire ici..." required></textarea>
                <div class="d-flex">
                    <?php if (isset($_GET['error']) && $_GET['error'] === 'nm') { ?>
                        <input id="inputName" class="commentary__error" type="text" name="name" placeholder="Entrez votre nom pour noter" required>
                    <?php } elseif (isset($_GET['error']) && $_GET['error'] === 'nau') { ?>
                        <input id="inputName" class="commentary__error" type="text" name="name" placeholder="Nom déjà utilisé !" required>
                    <?php } else { ?>
                        <input id="inputName" class="commentary__name" type="text" name="name" placeholder="Entrez votre nom" value="" required>
                    <?php } ?>
                    <button class="btn btn-outline-secondary" type="submit">Envoyer</button>
                </div>
            </form>

            <div class="operatorCard__buttons d-flex">
                <div class="dropdown">
                    <button class="btn__Rev__Sco btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Commentaires <?= count($operator->getReviews()) ?>
                    </button>
                    <div class="dropdown-menu p-3">
                        <div class="operatorCard__commentaries">
                            <?php foreach ($operator->getReviews() as $review) { ?>
                                <p><?= $review->getAuthor()->getName(); ?> :</p>
                                <p>" <?= $review->getMessage(); ?> "</p>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form class="operatorCard__grade" action="./Process/add_score.php" method="post">
                    <input type="hidden" name="operatorId" value="<?= $operator->getId() ?>">
                    <input class="score__name" type="hidden" name="name" value="" required>
                    <!-- <input class="number" type="number" name="value" min="1" max="5" required>
                    <button class="btn btn-secondary d-flex justify-content-between align-items-center gap-1" type="submit">
                        <p>Noter</p>
                        <p>★</p>
                    </button> -->
                    <div class="five-rate-active btn btn-secondary btn__Rev__Sco d-flex">
                        <p>Noter</p>
                        <button type="submit" name="value" value="1" class="rate-value-empty" aria-label="Noter 1 sur 5"><span aria-hidden="true">1</span></button>
                        <button type="submit" name="value" value="2" class="rate-value-empty" aria-label="Noter 2 sur 5"><span aria-hidden="true">2</span></button>
                        <button type="submit" name="value" value="3" class="rate-value-empty" aria-label="Noter 3 sur 5"><span aria-hidden="true">3</span></button>
                        <button type="submit" name="value" value="4" class="rate-value-empty" aria-label="Noter 4 sur 5"><span aria-hidden="true">4</span></button>
                        <button type="submit" name="value" value="5" class="rate-value-empty" aria-label="Noter 5 sur 5"><span aria-hidden="true">5</span></button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
    <?php $totalOperators ++; ?>
<?php } ?>