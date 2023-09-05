<?php

class Score {
    private int $id;
    private string $value;
    private Author $author;

    public function __construct(array $data, Author $author)
    {
        $this->hydrate($data);
        $this->setAuthor($author);
    }

    ////// GETTER & SETTER /////

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }

    //// METHODS ////

    public function hydrate(array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["value"])) {
            $this->setValue($data["value"]);
        }
    }
    
}