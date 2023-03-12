<?php
session_start();

//Luodaan yhteys tietokantaan
$tk=parse_ini_file(".ht.asetukset.ini");
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect($tk["databaseserver"], $tk["username"], $tk["password"], $tk["database"]);
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Ilmaistaan käyttäjätyyppi (user/admin)
$sql = "select team19_user.usertype from team19_user where tunnus='".$_SESSION['kayttaja']."'";
$result = mysqli_query($yhteys, $sql);
$usertype = mysqli_fetch_array($result);
$_SESSION['usertype'] = $usertype['usertype'];

if($_SESSION["usertype"]=='user'){
    header("Location:kirjauduajax.html");
    exit;
}
?>
<?php
$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

if (empty($poistettava)) {
    header("Location:savecomment.php");
    exit;
}

//Luodaan yhteys tietokantaan
$tk=parse_ini_file(".ht.asetukset.ini");
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect($tk["databaseserver"], $tk["username"], $tk["password"], $tk["database"]);
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Poistetaan kommentti
$sql="delete from team19_comment here id=?";

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