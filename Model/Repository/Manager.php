<?php

class Manager {
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

    public function getAllDestinations():array
    {
        $request = $this->db->query('SELECT * FROM destination');
        $destinationsData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsData;
    }

    public function getDestinationsByLocation(string $location):array
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

    public function getOperatorByDestinationId(int $id):array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $operatorsByDestinationIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $operatorsByDestinationIdData;
    }

    public function getDestinationsByOperatorId($id):array
    {
        $request = $this->db->prepare('SELECT * FROM destination WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $destinationsByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $destinationsByOperatorIdData;
    }

    public function getReviewsByOperatorId($id):array
    {
        $request = $this->db->prepare('SELECT * FROM review WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $reviewsByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $reviewsByOperatorIdData;
    }

    public function getScoresByOperatorId($id):array
    {
        $request = $this->db->prepare('SELECT * FROM score WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        $scoresByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $scoresByOperatorIdData;
    }

    public function getCertificateByOperatorId($id):array
    {
        $request = $this->db->prepare('SELECT expires_at, signatory FROM certificate WHERE tour_operator_id = :id');
        $request->execute([
            'id' => $id
        ]);
        if ($request->rowCount() > 0) {
            $certificateByOperatorIdData = $request->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $certificateByOperatorIdData = [];
        }

        return $certificateByOperatorIdData;
    }

    public function getAuthorByReviewId($id):array
    {
        $request = $this->db->prepare('SELECT * FROM author WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $authorByReviewIdData = $request->fetch(PDO::FETCH_ASSOC);

        return $authorByReviewIdData;
    }

    public function getAuthorByScoreId($id):array
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
}