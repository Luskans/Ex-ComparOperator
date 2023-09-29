<?php

// require_once($_SERVER['DOCUMENT_ROOT'] . '/Ex-ComparOperator/Utilities/Config/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Utilities/Config/autoload.php');

class Manager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    ///////////////////////////
    ///// GETTER & SETTER /////
    ///////////////////////////

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }

    ///////////////////
    ///// METHODS /////
    ///////////////////

    public function getAllDestinations(): array
    {
        $request = $this->db->query('SELECT * FROM destination');
        $destinationsData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsData;
    }

    public function getDestinationsByLocation(string $location): array
    {
        $request = $this->db->prepare('SELECT * FROM destination WHERE location = :location');
        $request->execute([
            'location' => $location
        ]);
        $destinationsByLocationData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsByLocationData;
    }

    public function getOperatorByDestinationId(int $id): array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $operatorsByDestinationIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $operatorsByDestinationIdData;
    }

    public function getDestinationsByOperatorId($id): array
    {
        $request = $this->db->prepare('SELECT * FROM destination WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $destinationsByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsByOperatorIdData;
    }

    public function getReviewsByOperatorId($id): array
    {
        $request = $this->db->prepare('SELECT * FROM review WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $reviewsByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $reviewsByOperatorIdData;
    }

    public function getScoresByOperatorId($id): array
    {
        $request = $this->db->prepare('SELECT * FROM score WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $scoresByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $scoresByOperatorIdData;
    }

    public function getCertificateByOperatorId($id): array
    {
        $request = $this->db->prepare('SELECT expires_at, signatory FROM certificate WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        if ($request->rowCount() > 0) {
            $certificateByOperatorIdData = $request->fetch(PDO::FETCH_ASSOC);
        } else {
            $certificateByOperatorIdData = [];
        }

        return $certificateByOperatorIdData;
    }

    public function getAuthorByReviewId($id): array
    {
        $request = $this->db->prepare('SELECT * FROM author WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $authorByReviewIdData = $request->fetch(PDO::FETCH_ASSOC);

        return $authorByReviewIdData;
    }

    public function getAuthorByScoreId($id): array
    {
        $request = $this->db->prepare('SELECT * FROM author WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $authorByScoreIdData = $request->fetch(PDO::FETCH_ASSOC);

        return $authorByScoreIdData;
    }

    public function getAllOperator(): array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator');
        $request->execute();
        $allOperators = $request->fetchAll();

        return $allOperators;
    }

    public function getOperatorById(int $id): TourOperator
    {
        $request = $this->db->prepare('SELECT * FROM `tour_operator` 
            INNER JOIN certificate ON certificate.tour_operator_id = tour_operator.id 
            WHERE tour_operator.id = :id');

        $request->execute([
            'id' => $id
        ]);

        $operatorPlusCertificateData = $request->fetch();

        $certificate = new Certificate([
            'expires_at' => $operatorPlusCertificateData['expires_at'],
            'signatory' => $operatorPlusCertificateData['signatory']
        ]);

        $destinationDatas = $this->getDestinationsByOperatorId($id);

        $destinations = [];

        foreach ($destinationDatas as $destinationData) {
            $destinations[] = new Destination([
                'id' => $destinationData['id'],
                'location' => $destinationData['location'],
                'price' => $destinationData['price'],
                'tour_operator_id' => $destinationData['tour_operator_id'],
                'image' => $destinationData['image'],
            ]);
        }

        $operator = new TourOperator([
            'id' => $operatorPlusCertificateData['id'],
            'name' => $operatorPlusCertificateData['name'],
            'link' => $operatorPlusCertificateData['link'],
            'isPremium' => $operatorPlusCertificateData['isPremium'],
        ], $destinations, [], [], $certificate);

        return $operator;
    }

    public function updateOperatorAndDestinations(TourOperator $operator)
    {
        $request = $this->db->prepare('UPDATE `tour_operator` 
            SET name = :name, link = :link, isPremium = :isPremium
            WHERE tour_operator.id = :id');

        $request->execute([
            'id' => $operator->getId(),
            'name' => $operator->getName(),
            'link' => $operator->getLink(),
            'isPremium' => $operator->getIsPremium()
        ]);

        foreach($operator->getDestinations() as $destination){
            $request = $this->db->prepare('INSERT INTO `destination` (location, price, tour_operator_id)
            VALUES (:location, :price, :tour_operator_id)');

            $request->execute([
                ':location' => $destination->getLocation(),
                ':price' => $destination->getPrice(),
                ':tour_operator_id' => $destination->getTour_operator_id()
            ]);
        }
    }
}
