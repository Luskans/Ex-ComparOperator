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
}