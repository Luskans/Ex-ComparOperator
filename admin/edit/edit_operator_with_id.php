<?php
require_once('../../Utilities/Config/db.php');
require_once('../../Utilities/Config/autoload.php');

require_once('../../Template/_admin/_admin_header.php');

// var_dump($_SERVER);
// die();

session_start();


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header("Location: login.php");
    exit;
}

$manager = new Manager($db);

$operator = $manager->getOperatorById($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locations = [];
    $prices = [];
    if (!empty($_POST['operator_name']) && !empty($_POST['operator_link']) && !empty($_POST['premium'])) {
        foreach ($_POST as $formLabel => $formData) {
            if($formLabel === "operator_name"){
                $operator->setName($formData);
            } else {
                if($formLabel === "operator_link"){
                    $operator->setLink($formData);
                } else {
                    if($formLabel === "premium"){
                        $operator->setIsPremium($formData);
                    } else {
                        if(str_contains($formLabel, 'destination' )){
                            $locations[] = $formData;
                        } else {
                            $prices[] = $formData;
                        }
                    }
                } 
                
            }
            
        }
        foreach($locations as $location){
            $priceIndex = 0;
            $destination = new Destination([
                'location' => $location,
                'price' => $prices[$priceIndex],
                'tour_operator_id' => $operator->getId()
            ]);

            $operator->addDestinationOneByOne($destination);

            $priceIndex ++;
        }
    }

    $manager->updateOperatorAndDestinations($operator);
}



?>

<div class="container d-flex flex-column align-items-center mt-5">



    <h2 class="mb-5">Modifier le voyagiste</h2>
    <form method="post" action="" class="w-50">
        <div class="mb-3">
            <label for="operator_name" class="form-label">Nom du voyagiste:</label>
            <input type="text" class="form-control" name="operator_name" value="<?= $operator->getName() ?>" required>
        </div>

        <div class="mb-3">
            <label for="operator_link" class="form-label">Site Web :</label>
            <input type="url" class="form-control" name="operator_link" value="<?= $operator->getLink() ?>" required><br>
        </div>

        <div class="mb-3">
            <select name="premium" id="premium">
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </div>

        <div class="">Destinations</div>
        <hr>

        <div id="destinationsAdmin" class="mb-3">
            <div class="d-flex justify-content-center gap-3 mb-3">
                <input type="text" class="form-control" name="destination1" placeholder="Destination 1" required>
                <input type="number" class="form-control" name="price1" placeholder="Prix 1" required><br>
            </div>

            <div id="addDestinationAdmin" class="btn btn-primary">Ajouter Destination</div>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <input type="submit" value="Confirmer" class="btn btn-success">
            <a href="../admin_edit_operator.php" class="btn btn-secondary">Retour</a>
        </div>

    </form>


</div>