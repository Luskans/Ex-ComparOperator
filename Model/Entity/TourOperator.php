<?php

class TourOperator {
    private int $id;
    private string $name;
    private string $link;
    private Certificate $certificate;
    private array $destinations = [];
    private array $reviews = [];
    private array $scores = [];
    private bool $isPremium;

    public function __construct(array $data, $destinationsData, $reviewsData, $scoresData, $certificateData)
    {
        $this->hydrate($data);
        $this->addDestinations($destinationsData);
        $this->addReviews($reviewsData);
        $this->addScores($scoresData);
        $this->addCertificate($certificateData);
    }

    ////// GETTER & SETTER /////

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    public function getCertificate() {
        return $this->certificate;
    }

    public function setCertificate($certificate) {
        $this->certificate = $certificate;
        return $this;
    }
 
    public function getDestinations() {
        return $this->destinations;
    }

    public function setDestinations($destinations) {
        $this->destinations[] = $destinations;
        return $this;
    }

    public function getReviews() {
        return $this->reviews;
    }

    public function setReviews($reviews) {
        $this->reviews[] = $reviews;
        return $this;
    }

    public function getScores() {
        return $this->scores;
    }

    public function setScores($scores) {
        $this->scores[] = $scores;
        return $this;
    }

    public function getIsPremium() {
        return $this->isPremium;
    }

    public function setIsPremium($isPremium) {
        $this->isPremium = $isPremium;
        return $this;
    }

    //// METHODS ////

    public function hydrate(array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["name"])) {
            $this->setName($data["name"]);
        }
        if (isset($data["link"])) {
            $this->setLink($data["link"]);
        }
        if (isset($data["certificate"])) {
            $this->setCertificate($data["certificate"]);
        }
        if (isset($data["isPremium"])) {
            $this->setIsPremium($data["isPremium"]);
        }
    }

    public function addDestinations(array $destinationsByOperatorId) {
        foreach ($destinationsByOperatorId as $destinationByOperatorId) {
            $this->destinations[] = new Destination($destinationByOperatorId);
        }
    }

    public function addReviews(array $reviewsByOperatorId) {
        foreach ($reviewsByOperatorId as $reviewByOperatorId) {
            $this->reviews[] = new Review($reviewByOperatorId);
        }
    }

    public function addScores(array $scoresByOperatorId) {
        foreach ($scoresByOperatorId as $scoreByOperatorId) {
            $this->scores[] = new Score($scoreByOperatorId);
        }
    }

    public function addCertificate(array $certificateByOperatorId) {
        $this->certificate = new Certificate($certificateByOperatorId);
    }

}