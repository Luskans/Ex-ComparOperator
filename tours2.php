<?php
require_once('./Utilities/Config/db.php');
require_once('./Model/Repository/Manager.php');
require_once('./Model/Entity/TourOperator.php');
require_once('./Model/Entity/Destination.php');
require_once('./Model/Entity/Review.php');
require_once('./Model/Entity/Score.php');

$manager = new Manager($db);

///// ETAPE 1
var_dump($_GET['destinationId']);

///// ETAPE 2
if (isset($_GET['destinationId'])) {
    $operatorsByDestinationIdData = $manager->getOperatorByDestinationId($_GET['destinationId']);
}
var_dump($operatorsByDestinationIdData);

///// ETAPE 3
foreach ($operatorsByDestinationIdData as $operatorByDestinationIdData) {
    var_dump($operatorByDestinationIdData);
    
    $destinationsByOperatorId = $manager->getDestinationsByOperatorId($operatorByDestinationIdData['id']);
    var_dump($destinationsByOperatorId);
    $reviewsByOperatorId = $manager->getReviewsByOperatorId($operatorByDestinationIdData['id']);
    $scoresByOperatorId = $manager->getScoresByOperatorId($operatorByDestinationIdData['id']);
    $certificateByOperatorId = $manager->getCertificateByOperatorId($operatorByDestinationIdData['id']);
    $operator = new TourOperator($operatorByDestinationIdData, $destinationsByOperatorId, $reviewsByOperatorId, $scoresByOperatorId, $certificateByOperatorId);
    ?>
    <pre>
        <?php print_r($operator); ?>
    </pre>
<?php } ?>

