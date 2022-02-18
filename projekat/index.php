<?php
   require_once("DButils.php");

   $db = new DButils();
   $all;
   $arene = $db->getAllArenas();
   $events = $db->getAllEvents();

   
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
    <a href="http://localhost/pehape/projekat/hala.php"><button>unesi halu</button></a><br>
    <a href="http://localhost/pehape/projekat/dogadjaj.php"><button>unesi dogadjaj</button></a><br>
    <a href="http://localhost/pehape/projekat/index.php?hale=1"><button>prikazi sve hale</button></a><br>
    <a href="index.php"><button>nazad na pocetnu</button></a>
    <form method="post">
        <input type="text" name="search">
        <input type="submit" value="pretrazi">
    </form>
    <?php
        session_start();
        if(isset($_SESSION["recent"]) && !empty($_SESSION["recent"])){
            echo "<p>poslednje pretrazivano:".$_SESSION["recent"]."</p>";
        }
        
        if(isset($_GET["hale"]) or isset($_POST["search"])){
            if(isset($_POST["search"])){
                $search = htmlspecialchars($_POST["search"]);
                $_SESSION["recent"] = $search;
                $searchResult = $db->searchEvents($search);
                foreach($searchResult as $s){
                    echo $s->getHTML();
                }
            }
            elseif($_GET["hale"]==1){
                foreach($arene as $a){
                    echo $a->getHTML();
                    echo "<br>";
                }
            }elseif($_GET["hale"]==2){
                $arenaEvents = $db->getEvents($_GET["idhale"]);
                foreach($arenaEvents as $ae){
                    echo $ae->getHTML();
                }
            }
            
        }else{
            foreach($events as $e){
                echo $e->getHTML();
                echo "<br>";
            }
        }
        
    ?>
</body>
</html>