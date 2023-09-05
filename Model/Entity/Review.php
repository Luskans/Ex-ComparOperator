<?php

class Review {
    private int $id;
    private string $message;
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

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
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
        if (isset($data["message"])) {
            $this->setMessage($data["message"]);
        }
    }
    

  
    
}