<?php

class Review {
    private int $id;
    private string $message;
    private Author $author;

    public function __construct(array $data)
    {
        $this->hydrate($data);
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

    public function getAuthor_id() {
        return $this->author_id;
    }

    public function setAuthor_id($author_id) {
        $this->author_id = $author_id;
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
        if (isset($data["author"])) {
            $this->setAuthor($data["author"]);
        }
    }
    

  
    
}