<?php
session_start();


if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header("Location: login.php");
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comparo_full"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Обработка отправки формы для добавления нового туроператора
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operatorName = $_POST["operator_name"];
    $country = $_POST["country"];

    // Вставляем данные о туроператоре в таблицу tour_operator
    $stmt = $conn->prepare("INSERT INTO tour_operator (name, country) VALUES (:name, :country)");
    $stmt->bindParam(':name', $operatorName);
    $stmt->bindParam(':country', $country);
    $stmt->execute();

    // Получаем ID только что добавленного туроператора
    $operatorId = $conn->lastInsertId();

    // Обработка направлений и цен (пример для первых двух направлений)
    for ($i = 1; $i <= 2; $i++) {
        $destinationField = "destination" . $i;
        $priceField = "price" . $i;

        if (!empty($_POST[$destinationField]) && !empty($_POST[$priceField])) {
            $destination = $_POST[$destinationField];
            $price = $_POST[$priceField];

            // Вставляем данные о направлении в таблицу destination
            $stmt = $conn->prepare("INSERT INTO destination (location, price, tour_operator_id) VALUES (:location, :price, :operator_id)");
            $stmt->bindParam(':location', $destination);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':operator_id', $operatorId);
            $stmt->execute();
        }
    }

   
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un voyagiste</title>
</head>
<body>
    <h2>Ajouter un voyagiste</h2>
    <form method="POST">
        
        <label for="operator_name">Nom du voyagiste:</label>
        <input type="text" name="operator_name" required><br>

        <label for="country">Pays:</label>
        <input type="text" name="country" required><br>

        <label for="destinations">Direction et prix:</label><br>

        <input type="text" name="destination1" placeholder="Direction 1" required>
        <input type="number" name="price1" placeholder="Prix 1" required><br>

        <input type="text" name="destination2" placeholder="Direction 2" required>
        <input type="number" name="price2" placeholder="Prix 2" required><br>

        

        <button type="submit">Ajouter un voyagiste</button>
    </form>
</body>
</html>