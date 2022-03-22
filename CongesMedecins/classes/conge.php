<?php

   class Conge
   {
      private $idC;
      private $debutC;
      private $finC;
      private $validationC;
      private $praticienC;
      
      public function __construct($idC, $debutC, $finC, $validationC)
      {
        $this->idC = $idC;
        $this->debutC = $debutC;
        $this->finC = $finC;
        $this->validationC = $validationC;
        $this->praticienC = null;
      }
      
      public function getId()
      {
        return $this->idC;
      }

      public function setDebut($debutC)
      {
        $this->debutC = $debutC;
      }
      
      public function getDebut()
      {
        return $this->debutC;
      }

      public function setFin($finC)
      {
        $this->finC = $finC;
      }
      
      public function getFin()
      {
        return $this->finC;
      }

      public function setValidation($validationC)
      {
        $this->validation = $validationC;
      }
      
      public function getValidation()
      {
        return $this->validationC;
      }

      public function setPraticien($praticienC)
      {
        $this->praticienC = $praticienC;
      }

      public function getPraticien()
      {
        return $this->praticienC;
      }
    }
?>
