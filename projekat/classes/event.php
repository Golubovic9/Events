<?php

    class Event{
        private $id;
        private $naziv;
        private $tip;
        private $kapacitet;
        private $datum;
        private $opis;
        private $arena;

        function __construct($id,$naziv,$tip,$kapacitet,$datum,$opis,$arena){
            $this->id = $id;
            $this->naziv= $naziv;
            $this->tip = $tip;
            $this->kapacitet = $kapacitet;
            $this->datum = $datum;
            $this->opis=$opis;
            $this->arena= $arena;
        }

        function getId(){
            return $this->id;
        }

        function getNaziv(){
            return $this->naziv;
        }

        function getKapacitet(){
            return $this->kapacitet;
        }

        function getArenaName(){
            $db= new DButils();
            $arena = $db->getArena($this->arena);
            return $arena->getNaziv();
        }

        function getHTML(){
            return "<div class=\"court\">
                        <p>{$this->naziv}</p>
                        <p>{$this->tip}</p>
                        <p>{$this->datum}</p>
                        <p>{$this->opis}</p>
                        <p>".$this->getArenaName()."</p>
                        <a href=http://localhost/pehape/projekat/reserve.php?dogadjaj=$this->id><button>rezervisi kartu</button></a>
                    </div>";
        }

    }
?>