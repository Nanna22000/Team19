<?php
$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

if (empty($poistettava)) {
    header("Location:savecomment.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

//Luodaan yhteys tietokantaan
try{
    $yhteys=mysqli_connect("db", "root", "password", "userbase");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

//Poistetaan kommentti
$sql="delete from comment where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:visitorsbook.php");
exit;
?>