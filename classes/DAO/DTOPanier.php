<?php

class DTOPanier{
    
    private $produitId;
    private $clientId;
    private $qt;
    
    public function getProduitId() {
        return $this->produitId;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function getQt() {
        return $this->qt;
    }

    public function setProduitId($produitId) {
        $this->produitId = $produitId;
        return $this;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
        return $this;
    }

    public function setQt($qt) {
        $this->qt = $qt;
        return $this;
    }


}

