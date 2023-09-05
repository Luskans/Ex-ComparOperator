<?php

class Certificate {
    private string $expiresAt;
    private string $signatory;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    ////// GETTER & SETTER /////

    public function getExpiresAt() {
        return $this->expiresAt;
    }

    public function setExpiresAt($expiresAt) {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    public function getSignatory() {
        return $this->signatory;
    }

    public function setSignatory($signatory) {
        $this->signatory = $signatory;
        return $this;
    }

    //// METHODS ////

    public function hydrate(array $data)
    {
        if (isset($data["expires_at"])) {
            $this->setExpiresAt($data["expires_at"]);
        }
        if (isset($data["signatory"])) {
            $this->setSignatory($data["signatory"]);
        }
    }
    

 
    
}