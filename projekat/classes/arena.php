<?php
   
    class Arena{
        private $id;
        private $naziv;
        private $godiste;
        private $kapacitet;
        private $slika;
        private $opis;

        function __construct($id,$naziv,$godiste,$kapacitet,$slika,$opis){
            $this->id = $id;
            $this->naziv= $naziv;
            $this->godiste = $godiste;
            $this->kapacitet = $kapacitet;
            $this->slika = $slika;
            $this->opis = $opis;
        }
        
        function getId(){
            return $this->id;
        }

        function getNaziv(){
            return $this->naziv;
        }

        function getGodiste(){
            return $this->godiste;
        }

        function getKapacitet(){
            return $this->kapacitet;
        }

        function getOpis(){
            return $this->opis;
        }

        function getHTML(){
            return  "<li><a href=http://localhost/pehape/projekat/index.php?hale=2&idhale={$this->id}><div class=\"court\">
                    <p>{$this->naziv}</p>
                    <img src={$this->slika}></img>
                    </div></a></li>";
        }

    }

?>