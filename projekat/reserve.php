<?php
    require_once("DButils.php");
   
    
     
     $idEvent= $_GET["dogadjaj"];
     $db = new DButils();
     $event = $db->getEvent($idEvent);
     $kapacitet = $event->getKapacitet();
     if(isset($_POST["rez"])){
        
        if( !empty($_POST["mejl"]) && !empty($_POST["ime"]) && !empty($_POST["telefon"]) && !empty($_GET["seat"]) ){
            $name = htmlspecialchars($_POST["ime"]);
            $telefon =  htmlspecialchars($_POST["telefon"]);
            $mejl = htmlspecialchars($_POST["mejl"]);
            $seat = htmlspecialchars($_GET["seat"]);
            if($db->insertReservation($name,$telefon,$seat,$mejl,$idEvent)){
                header("Location: index.php");

            }else{
                echo "rezervacija nije uspela";
            }
        }else{
            echo "morate popuniti sva polja i odabrati sediste da biste rezervisali";
        }
    }
    
    $vrsta = $kapacitet / 50;
    $kolona= 50;
    $res = $db->getFreeSeats($idEvent,$vrsta,$kolona);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        ime:<input type="text" name="ime">
        telefon:<input type="text" name="telefon">
        e-mail:<input type="text" name="mejl">
        <input type="submit" value="rezervisi" name="rez">
    </form>
    <br>
    <div>
    <?php
        
        foreach($res as $rows=>$colums){
           echo "<div>";
            foreach($colums as $key=>$value){
                if(isset($_GET["seat"])){
                    if("$rows-$key" == $_GET["seat"]){
                         echo  "<a href=?dogadjaj=".$_GET["dogadjaj"]."&seat=$rows-$key><div id=\"chosen\"></div></a>";
                        continue;
                    }
                }
                if($value)
                    echo  "<a href=?dogadjaj=".$_GET["dogadjaj"]."&seat=$rows-$key><div id=\"free\"></div></a>";
                else 
                    echo"<div id=\"reserved\"></div>";
            }
            echo "</div>";
        }
        
    ?>
    </div>
   
</body>
</html>