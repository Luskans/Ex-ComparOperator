<?php

class Destination {
    private int $id;
    private string $location;
    private int $price;
    private int $tour_operator_id;
    private string $image;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    ////// GETTER & SETTER /////

    public function getId() {
        return $this->id;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTour_operator_id() {
        return $this->tour_operator_id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLocation($location) {
        $this->location = $location;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function setTour_operator_id($tour_operator_id) {
        $this->tour_operator_id = $tour_operator_id;
        return $this;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    //// METHODS ////

    public function hydrate(array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["location"])) {
            $this->setLocation($data["location"]);
        }
        if (isset($data["price"])) {
            $this->setPrice($data["price"]);
        }
        if (isset($data["tour_operator_id"])) {
            $this->setTour_operator_id($data["tour_operator_id"]);
        }
        if (isset($data["image"])) {
            $this->setImage($data["image"]);
        }
    }
}