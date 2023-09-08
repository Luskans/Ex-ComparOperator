<?php
require_once('../Utilities/Config/db.php');
require_once('../Utilities/Config/autoload.php');

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header("Location: login.php");
    exit;
}

$manager = new Manager($db);

$operatorDatas = $manager->getAllOperator();

$operators = [];

foreach ($operatorDatas as $operatorData) {

    $certificate = new Certificate($manager->getCertificateByOperatorId($operatorData['id']));

    $operators[] = new TourOperator($operatorData, [], [], [], $certificate);
}

?>
<main>
    <ul>
        <?php
        foreach ($operators as $operator) {
        ?>
            <a href="edit/edit_operator_with_id.php?id=<?php echo $operator->getId() ?>">
                <li>
                    <?php echo $operator->getName() ?>
                </li>
            </a>
        <?php
        } ?>

    </ul>
    <a href="./admin_dashboard.php">Retour</a>
</main>