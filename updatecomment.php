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
$sql = "select kayttaja.usertype from kayttaja where tunnus='".$_SESSION['kayttaja']."'";
$result = mysqli_query($yhteys, $sql);
$usertype = mysqli_fetch_array($result);
$_SESSION['usertype'] = $usertype['usertype'];

if($_SESSION["usertype"]=='user'){
    header("Location:kirjauduajax.html");
    exit;
}
?>
<?php
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$username=isset($_POST["username"]) ? $_POST["username"] : "";
$message=isset($_POST["message"]) ? $_POST["message"] : "";

//Jos jokin kentistä on tyhjä, viedään käyttäjä takaisin visitorsbook-sivulle
if (empty($id) || empty($username) || empty($message)){
    header("Location:./visitorsbook.php");
    exit;
}

$tk=parse_ini_file(".ht.asetukset.ini");
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect($tk["databaseserver"], $tk["username"], $tk["password"], $tk["database"]);
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Päivitetään viesti ja käyttäjänimi
$sql="update comment set message=?, username=? where id=?";

$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ssi', $message, $username, $id);
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

header("Location:./visitorsbook.php");
?>