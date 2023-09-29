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

    public function getDestinationsBySearch(string $search):array
    {
        $request = $this->db->prepare('SELECT * FROM destination WHERE location LIKE :search');
        $request->execute([
            'search' => '%'.$search.'%'
        ]);
        $destinationsBySearchData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsBySearchData;
    }

    public function getDestinationsByPriceUp():array
    {
        $request = $this->db->query('SELECT * FROM destination ORDER by price ASC');
        $destinationsBySearchData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsBySearchData;
    }

    public function getDestinationsByPriceDown():array
    {
        $request = $this->db->query('SELECT * FROM destination ORDER by price DESC');
        $destinationsBySearchData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsBySearchData;
    }

    public function getOperatorByDestinationId(int $id): array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id ORDER BY isPremium DESC');
        $request->execute([
            'id' => $id
        ]);
        $operatorsByDestinationIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $operatorsByDestinationIdData;
    }

    // public function getOpByDestIdByScoreUp(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT tour_operator.* 
    //     FROM tour_operator 
    //     LEFT JOIN score ON tour_operator.id = score.tour_operator_id 
    //     WHERE tour_operator.id = :id 
    //     ORDER BY score.value ASC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreUpData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreUpData;
    // }

    // public function getOpByDestIdByScoreDown(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT tour_operator.* 
    //     FROM tour_operator 
    //     LEFT JOIN score ON tour_operator.id = score.tour_operator_id 
    //     WHERE tour_operator.id = :id 
    //     ORDER BY score.value DESC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreDownData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreDownData;
    // }

    // public function getOpByDestIdByPriceUp(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT * FROM tour_operator INNER JOIN score ON tour_operator.id = score.tour_operator_id WHERE tour_operator.id = :id ORDER BY score.value ASC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreUpData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreUpData;
    // }

    // public function getOpByDestIdByPriceDown(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT * FROM tour_operator INNER JOIN score ON tour_operator.id = score.tour_operator_id WHERE tour_operator.id = :id ORDER BY score.value ASC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreUpData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreUpData;
    // }

    // public function getOpByDestIdByReviewUp(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT * FROM tour_operator INNER JOIN score ON tour_operator.id = score.tour_operator_id WHERE tour_operator.id = :id ORDER BY score.value ASC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreUpData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreUpData;
    // }

    // public function getOpByDestIdByReviewDown(int $id):array
    // {
    //     $request = $this->db->prepare('SELECT * FROM tour_operator INNER JOIN score ON tour_operator.id = score.tour_operator_id WHERE tour_operator.id = :id ORDER BY score.value ASC');
    //     $request->execute([
    //         'id' => $id
    //     ]);
    //     $opByDestIdByScoreUpData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $opByDestIdByScoreUpData;
    // }

    public function getOpByDestIdBySearch(int $id, string $search):array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id AND name LIKE :search');
        $request->execute([
            'id' => $id,
            'name' => '%' . $search . '%'
        ]);
        $getOpByDestIdBySearchData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $getOpByDestIdBySearchData;
    }

    public function getThreeRandomPremiumOperators():array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator WHERE isPremium = :isPremium ORDER BY RAND()');
        $request->execute([
            'isPremium' => 1
        ]);
        $threeRandomPremiumOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $threeRandomPremiumOperatorData;
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

    public function createReview($name, $message, $tour_operator_id)
    {
        $request = $this->db->prepare('INSERT INTO author (name) VALUES (:name)');
        $request->execute([
            'name' => $name,
        ]);

        $author_id = $this->db->lastInsertId();

        $request = $this->db->prepare('INSERT INTO review (message, tour_operator_id, author_id) VALUES (:message, :tour_operator_id, :author_id)');
        $request->execute([
            'message' => $message,
            'tour_operator_id' => $tour_operator_id,
            'author_id' => $author_id
        ]);
    }

    public function createScore($name, $value, $tour_operator_id)
    {
        $request = $this->db->prepare('INSERT INTO author (name) VALUES (:name)');
        $request->execute([
            'name' => $name,
        ]);

        $author_id = $this->db->lastInsertId();

        $request = $this->db->prepare('INSERT INTO score (value, tour_operator_id, author_id) VALUES (:value, :tour_operator_id, :author_id)');
        $request->execute([
            'value' => $value,
            'tour_operator_id' => $tour_operator_id,
            'author_id' => $author_id
        ]);
    }

    public function checkAuthor($name)
    {
        $request = $this->db->prepare('SELECT COUNT(*) FROM author WHERE name = :name');
        $request->execute([
            'name' => $name
        ]);
        $count = $request->fetchColumn();

        return $count;
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
