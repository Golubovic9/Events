<?php
    require_once("DButils.php");
    $db = new DButils();
    $arene= $db->getAllArenas();

    if(isset($_POST["pressed"])){
        $ime = htmlspecialchars($_POST["ime"]);
        setcookie("ime",$ime,time()+3600);
        $tip = htmlspecialchars($_POST["tip"]);
        setcookie("tip",$tip,time()+3600);
        $datum = htmlspecialchars($_POST["datum"]);
        setcookie("datum",$datum,time()+3600);
        $opis = htmlspecialchars($_POST["opis"]);
        setcookie("opis",$opis,time()+3600);
            $arena= $_POST["arena"];
            $kap = $db->getArena($arena)->getKapacitet();
            if($db->insertEvent($ime,$tip,$kap,$datum,$opis,$arena))
                echo "uspesno unet dogadjaj";
            else    
                echo "nije uspeo unos dogadjaja";
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <select name="arena">
            <?php
                foreach($arene as $a){
                    echo "<option value=".$a->getId().">".$a->getNaziv()."</option>";
                }
            ?>
        </select><br>   
        naziv:<input type="text" name="ime" value="<?php echo isset($_COOKIE["ime"])? $_COOKIE["ime"]:""; ?>"><br>
        tip:<input type="text" name="tip" value="<?php echo isset($_COOKIE["tip"])? $_COOKIE["tip"]:""; ?>"><br>
        datum:<input type="text" name="datum" value="<?php echo isset($_COOKIE["datum"])? $_COOKIE["datum"]:""; ?>"><br>
        opis:<input type="text" name="opis" value="<?php echo isset($_COOKIE["opis"])? $_COOKIE["opis"]:""; ?>"><br>
        <input type="submit" value="unesi" name="pressed">
    </form>
    <a href="index.php">nazad na pocetnu</a>
</body>
</html>