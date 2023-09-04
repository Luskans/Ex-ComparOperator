<?php

class Certificate {
    private int $expiresAt;
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
        if (isset($data["expiresAt"])) {
            $this->setExpiresAt($data["expiresAt"]);
        }
        if (isset($data["signatory"])) {
            $this->setSignatory($data["signatory"]);
        }
    }
    

 
    
}