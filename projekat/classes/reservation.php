<?php
    class Reservation{
        private $id;
        private $ime;
        private $telefon;
        private $email;
        private $sediste;
        private $dogadjaj;

        public function __construct($id,$ime,$fon,$mejl,$sediste,$dogadjaj){
            $this->id = $id;
            $this->ime = $ime;
            $this->telefon = $fon;
            $this->email = $mejl;
            $this->sediste = $sediste;
            $this->dogadjaj = $dogadjaj;
        }
            
    }
?>