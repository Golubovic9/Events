<?php
    require_once("classes/arena.php");
    require_once("classes/event.php");
    class DButils{
        private $conn;
        
        function __construct(){
            $host = "localhost";
			$database = "dvorane";
			$user = "root";
			$password = "";
			$this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        }

        public function __destruct() {
	    	$this->conn = null;
	    }

        function getAllArenas(){
            $result = array();
            $sql = "SELECT * FROM Arena ";
            try {
				$data = $this->conn->query($sql);
				foreach ($data as $d) {
					$result[] = new Arena($d["idArena"],$d["naziv"],$d["godinaIzgradnje"],$d["kapacitet"],$d["slika"],$d["opis"]);
				}
	    	} catch (PDOException $e) {
				echo $e->getMessage();
			}
			return $result;
        }

        function getAllEvents(){
            $result = array();
            $sql = "SELECT * FROM Event";
            try{
                $data = $this->conn->query($sql);
                foreach($data as $d){
                    $result[] = new Event($d["idEvent"],$d["naziv"],$d["tip"],$d["kapacitet"],$d["datum"],$d["opis"],$d["Arena_idArena"]);
                }
            }catch (PDOException $e) {
				echo $e->getMessage();
            }
            return $result;
        }

        function insertArena($ime,$god,$kap,$foto,$opis){
            $sql= "INSERT INTO Arena (naziv,godinaIzgradnje,kapacitet,slika,opis) 
                    VALUES (:naziv,:godina,:kap,:slika,:opis);";
            try{
                $st = $this->conn->prepare($sql);
                $st->bindValue(":naziv",$ime);
                $st->bindValue(":godina",$god);
                $st->bindValue(":kap",$kap);
                $st->bindValue(":slika",$foto);
                $st->bindValue(":opis",$opis);
                $st->execute();
            }catch(PDOexception){
                return false;
            }
            return true;
        }

        function insertEvent($ime,$tip, $kap,$datum,$opis,$arena){
            $sql = "INSERT INTO Event ( naziv, tip,kapacitet,datum,opis,Arena_idArena)
                    VALUES (:naziv, :tip,:kapacitet, STR_TO_DATE(:datum, '%Y-%m-%d'), :opis, :arena);";
            try{
                $st = $this->conn->prepare($sql);
                $st->bindValue(":naziv",$ime);
                $st->bindValue(":tip",$tip);
                $st->bindValue(":kapacitet",$kap);
                $st->bindValue(":datum",$datum);
                $st->bindValue(":opis",$opis);
                $st->bindValue(":arena",$arena);
                $st->execute();
            }catch(PDOexception $e){
                echo $e->getMessage();
                return false;
            } 
            return true;     
        }

        function insertReservation($ime,$fon,$sediste,$mejl,$dogadjaj){
            $sql = 'INSERT INTO Reservation (ime ,telefon ,email ,sediste, Event_idEvent )
                    VALUES (:ime,:fon,:mejl,:sediste,:dogadjaj);';
            try{
                $st = $this->conn->prepare($sql);
                $st->bindValue(":ime",$ime);
                $st->bindValue(":fon",$fon);
                $st->bindValue(":mejl",$mejl);
                $st->bindValue(":sediste",$sediste);
                $st->bindValue(":dogadjaj",$dogadjaj);
                $st->execute();
            }catch(PDOexception $e){
                echo $e->getMessage();
                return false;
            } 
            return true;  
        }

        function getArena($arena){
            $sql="SELECT * FROM Arena  WHERE idArena=$arena" ;
            $row = $this->conn->query($sql);
            foreach($row as  $r)
                 $hala = new Arena($r["idArena"],$r["naziv"],$r["godinaIzgradnje"],$r["kapacitet"],$r["slika"],$r["opis"]);
            return $hala;
        }

        function getEvents($arena){
            $result = array();
            $sql="SELECT * FROM Event  WHERE Arena_idArena=$arena" ;
            $rows = $this->conn->query($sql);
            foreach($rows as $row){
                $result[] = new Event($row["idEvent"],$row["naziv"],$row["tip"],$row["kapacitet"],$row["datum"],$row["opis"],$row["Arena_idArena"]); 
            }
            return $result;
        }

        function getEvent($id){
            $sql = "SELECT * FROM Event WHERE idEvent=$id" ;
            $row = $this->conn->query($sql);
            foreach($row as $r){
                $event = new Event($r["idEvent"],$r["naziv"],$r["tip"],$r["kapacitet"],$r["datum"],$r["opis"],$r["Arena_idArena"]);
            }
            return $event;
        }

        function searchEvents($name){
            $allEvents = $this->getAllEvents();
            $searchedEvents = array();
            foreach($allEvents as $a){
                if(stristr($a->getNaziv(),$name))
                    $searchedEvents[] = $a;
            } 
            return $searchedEvents;
        }

        function getFreeSeats($id,$rows,$colums){
            $sql = "SELECT * FROM Reservation WHERE Event_idEvent=$id";
            $queryResults = $this->conn->query($sql);
            $result = array();
            for($i=0; $i<$rows; $i++){
                $result[$i]= array();
                for($j=0; $j<$colums; $j++){
                    $result[$i][$j]=true;
                }
            }
            foreach($queryResults as $qr){
                $seat = explode("-",$qr["sediste"]);
                $result[$seat[0]][$seat[1]]=false;
            }
            return $result;
        }

    }

?>