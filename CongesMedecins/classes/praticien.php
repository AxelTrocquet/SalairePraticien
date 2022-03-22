<?php
   class praticien
   {
      private $idP;
      private $identifiantP;
      private $nomP;
      private $prenomP;
      private $adresse;
      private $coef_notorieteP;
      private $salaireP;
      private $mdpP;
      private $type_praticienP;
      private $villeP;
      
      public function __construct($idP, $identifiantP, $nomP, $prenomP, $adresseP, $notorieteP, $salaireP, $mdpP, $typeP, $villeP)
      {
        $this->idP = $idP;
        $this->identifiantP = $identifiantP;
        $this->nomP = $nomP;
        $this->prenomP = $prenomP;
        $this->adresseP= $adresseP;
        $this->coef_notorieteP = $notorieteP;
        $this->salaireP = $salaireP;
        $this->mdpP = $mdpP;
        $this->type_praticienP = $typeP;
        $this->villeP = $villeP;
      }
      
      public function getId()
      {
        return $this->idP;
      }

      public function setIdentifiant($identifiantP)
      {
        $this->identifiantP = $identifiantP;
      }

      public function getIdentifiant()
      {
        return $this->identifiantP;
      }

      public function setNom($nomP)
      {
        $this->nomP = $nomP;
      }

      public function getNom()
      {
        return $this->nomP;
      }

      public function setPrenom($prenomP)
      {
        $this->prenomP = $prenomP;
      }

      public function getPrenom()
      {
        return $this->prenomP;
      }

      public function setAdresse($adresseP)
      {
        $this->adresseP = $adresseP;
      }

      public function getAdresse()
      {
        return $this->adresseP;
      }

      public function setNotoriete($notorieteP)
      {
        $this->coef_notorieteP = $notorieteP;
      }

      public function getNotoriete()
      {
        return $this->coef_notorieteP;
      }

      public function setSalaire($salaireP)
      {
        $this->salaireP = $salaireP;
      }

      public function getSalaire()
      {
        return $this->salaireP;
      }

      public function setMdp($mdpP)
      {
        $this->mdpP = $mdpP;
      }
      
      public function getMdp()
      {
        return $this->mdpP;
      }

      public function setTypePraticien($typePraticienP)
      {
        $this->type_praticienP = $typePraticienP;
      }
      
      public function getTypePraticien()
      {
        return $this->type_praticienP;
      }

      public function setVille($villeP)
      {
        $this->villeP = $villeP;
      }
      
      public function getVille()
      {
        return $this->villeP;
      }
   }
?>
