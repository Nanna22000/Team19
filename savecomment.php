<?php
if(!isset($_SESSION["kayttaja"])) {
    header('Location: kirjauduajax.html');
}

$message = isset($_POST["message"]) ? $_POST["message"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";

$tk=parse_ini_file(".ht.asetukset.ini");
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect($tk["databaseserver"], $tk["username"], $tk["password"], $tk["database"]);
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Jos kentät eivät ole tyhjiä, siirretään arvot tietokantaan
if (!empty($message) || !empty($username)) {
    $sql = "insert into team19_comment (message, username) values(?,?)";
    //Valmistellaan sql-lause
    $stmt = mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $message, $username);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);

    $last_id = mysqli_insert_id($yhteys);

    header("Location:visitorsbook.php");
    exit;
}
?>