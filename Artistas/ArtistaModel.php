<?php

class ArtistaModel

{

  private $Id, $Name, $Country, $massage;

    public function __construct(){
        
    }
    public function getName() { 

      return $this->Name;
    }

     public function setName($Name){ 

      $this->Name = $Name;
    }

    public function getCountry() {

      return $this->Country; 
    }
     public function setCountry($Country){

          $this->Country= $Country; 
        }
     public function getId() {

          return $this->Id;
     }
     public function setId($Id){ 

         $this->Id = $Id; 
        }

      public function getMassage() {
          
        return $this->massage;
      }

      public function setMassage($massage)
      {
        return $this->massage = $massage;

      }
}
