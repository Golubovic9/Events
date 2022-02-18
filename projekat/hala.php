<?php
    require_once("DButils.php");
    $db = new DButils();
    if(isset($_POST["uneto"])){
        $ime = htmlspecialchars($_POST["ime"]);
        $god = htmlspecialchars($_POST["godiste"]);
        $kap = htmlspecialchars($_POST["kapacitet"]);
        $foto = htmlspecialchars($_POST["slika"]);
        $opis = htmlspecialchars($_POST["opis"]);
        if($db->insertArena($ime,$god,$kap,$foto,$opis))
            echo "uspesno uneta hala";
        else
            echo "nije uneta";
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
        ime:              <input type="text" name="ime"><br>
        godina izgradnje: <input type="text" name="godiste"><br>
        kapacitet(treba da bude deljiv sa 50):        <input type="text" name="kapacitet"><br>
        url slike:       <input type="text" name="slika"><br>
        opis:             <input type="text" name="opis"><br>
                         <input type="submit" value="unesi" name="uneto">
    </form>
    <a href="index.php">nazad na pocetnu</a>
</body>
</html>