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

    public function getDestinationById($id):array
    {
        $request = $this->db->prepare('SELECT * FROM destination WHERE id = :id');
        $request->execute([
            'id' => $id
        ]);
        $destinationData = $request->fetch(PDO::FETCH_ASSOC);

        return $destinationData;
    }

    public function getAllOperator():array
    {
        $request = $this->db->query('SELECT * FROM tour_operator');
        $operatorsData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $operatorsData;
    }

    // public function getOperatorByDestination() {
    //     $request = $this->db->query('SELECT * FROM tour_operator INNER JOIN destination 
    //     ON tour_operator.id = destination.tour_operator_id');
    //     $operatorByDestinationData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $operatorByDestinationData;
    // }

    // public function getOperatorByDestination() {
    //     $request = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id');
    //     $request->execute([
    //         'id' => $_GET['tour_operator_id']
    //     ]);
    //     $operatorByDestinationData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $operatorByDestinationData;
    // }

    public function getOperatorByDestination(Destination $destination):array
    {
        $request = $this->db->prepare('SELECT * FROM tour_operator INNER JOIN destination 
        ON tour_operator.id = destination.tour_operator_id 
        WHERE destination.id = :id');
        $request->execute([
            'id' => $destination->getId()
        ]);
        $operatorsByDestinationData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $operatorsByDestinationData;
    }

    // public function getReviewByOperatorId() {
    //     $request = $this->db->query('SELECT * FROM review INNER JOIN tour_operator 
    //     ON review.tour_operator_id = tour_operator.id');
    //     $reviewByOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $reviewByOperatorData;
    // }

    public function getReviewByOperatorId(TourOperator $operator) {
        $request = $this->db->prepare('SELECT * FROM review WHERE id = :id');
        $request->execute([
            'id' => $operator->getId()
        ]);
        $reviewByOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

        return $reviewByOperatorData;
    }

    // public function getScoreByOperatorId() {
    //     $request = $this->db->query('SELECT * FROM score INNER JOIN tour_operator 
    //     ON score.tour_operator_id = tour_operator.id');
    //     $scoreByOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $scoreByOperatorData;
    // }

    // public function getScoreByOperatorId(TourOperator $operator) {
    //     $request = $this->db->prepare('SELECT * FROM score WHERE id = :id');
    //     $request->execute([
    //         'id' => $operator->getId()
    //     ]);
    //     $scoreByOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $scoreByOperatorData;
    // }

    // public function getAuthorByReviewId(Review $review) {
    //     $request = $this->db->prepare('SELECT * FROM author WHERE id = :id');
    //     $request->execute([
    //         'id' => $review->getAuthor_id()
    //     ]);
    //     $scoreByOperatorData = $request->fetchAll(PDO::FETCH_ASSOC);

    //     return $scoreByOperatorData;
    // }
        

    public function updateOperatorToPremium() {
        $request = $this->db->prepare('UPDATE tour_operator SET isPremium = :isPremium WHERE id = :id');
        $request->execute([
            'isPremium' => true,
            'author' => $_POST['author']
        ]);
    }

    public function createTourOperator() {
        $request = $this->db->prepare('INSERT INTO tour_operator (name, link) VALUES (:name, :link)');
        $request->execute([
            'name' => $_POST['name'],
            'link' => $_POST['link']
        ]);
    }

    public function createDestination(Destination $destination) {
        $request = $this->db->prepare('INSERT INTO destination (id, location, price) VALUES (:id, :location, :price)');
        $request->execute([
            'id' => $destination->getId(),
            'location' => $destination->getLocation(),
            'price' => $destination->getPrice()
        ]);
    }

    public function createReview() {
        $request = $this->db->prepare('INSERT INTO review (message, author) VALUES (:message, :author)');
        $request->execute([
            'message' => $_POST['message'],
            'author' => $_POST['author']
        ]);
    }

    public function createScore() {
        $request = $this->db->prepare('INSERT INTO review (message, author) VALUES (:message, :author)');
        $request->execute([
            'message' => $_POST['message'],
            'author' => $_POST['author']
        ]);
    }

}