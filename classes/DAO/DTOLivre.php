<?php

class DTOLivre{
    
    /**
     *
     * @var int
     */
    private $id;
    /**
     *
     * @var string 
     */
    private $titre;
    /**
     *
     * @var float
     */
    private $prix;
    /**
     *
     * @var DateTime
     */
    private $date_achat;
    /**
     *
     * @var int
     */
    private $editeur_id;
    /**
     *
     * @var int
     */
    private $genre_id;
    /**
     *
     * @var int
     */
    private $auteur_id;
            
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getDate_achat() {
        return $this->date_achat;
    }

    public function getEditeur_id() {
        return $this->editeur_id;
    }

    public function getGenre_id() {
        return $this->genre_id;
    }

    public function getAuteur_id() {
        return $this->auteur_id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setDate_achat($date_achat) {
        $this->date_achat = $date_achat;
        return $this;
    }

    public function setEditeur_id($editeur_id) {
        $this->editeur_id = $editeur_id;
        return $this;
    }

    public function setGenre_id($genre_id) {
        $this->genre_id = $genre_id;
        return $this;
    }

    public function setAuteur_id($auteur_id) {
        $this->auteur_id = $auteur_id;
        return $this;
    }


}

