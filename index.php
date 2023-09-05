<?php include('./Template/template_header.php'); ?>

<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/Destination.php');

$manager = new Manager($db);
$destinationsData = $manager->getAllDestinations(); ?>

<main class="destination mb-5">
    <div class="container destinationCards d-flex flex-wrap gap-3">
        <?php foreach ($destinationsData as $destinationData) {
            $destination = new Destination($destinationData); ?>
            <div class="destinationCard">
                <div class="destinationCard__image">
                    <img src="<?= $destination->getImage() ?>">
                </div>
                <h3 class="destinationCard__location">
                    <?= $destination->getLocation(); ?>
                </h3>
                <p class="destinationCard__price">
                    <?= $destination->getPrice(); ?> €
                </p>
                <form action="./tours.php" method="get">
                    <input type="hidden" name="destinationLocation" value="<?= $destination->getLocation() ?>">
                    <!-- <input type="hidden" name="operatorId" value="<?= $destination->getTour_operator_id() ?>"> -->
                    <button type="submit">Voir les tours</button>
                </form>
            </div>
        <?php } ?>
    </div>
</main>

<?php include('./Template/template_footer.php'); ?>