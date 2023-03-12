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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kiia Kuokkala">
    <meta name="description" content="cat cafe, about us info">
    <meta name="keywords" content="cat, kitten, coffee, cafe, café">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style-confirmlogin.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/css/images/logo.png">
    <title>Cat Café ✿ Edit comment</title>
</head>
<body>

<header>
        <div class="topnav">
            <a class="active" href="index.html">Home</a>
            <a href="aboutus.html">About us</a>
            <a href="menu.html">Menu</a>
            <a href="cats.html">Our cats</a>
            <a href="confirmlogin.php">Visitor's book</a>
            <a href="signuplogin.html">Log in</a>
        </div>

    </header>

    <!-- Sivun animaatio -->

    <div class="animated animatedFadeInUp fadeInUp">

<style>
    @-webkit-keyframes fadeInUp {
from {
    transform: translate3d(0,40px,0)
}

to {
    transform: translate3d(0,0,0);
    opacity: 1
}
}

.animated {
animation-duration: 1s;
animation-fill-mode: both;
-webkit-animation-duration: 1s;
-webkit-animation-fill-mode: both
}

.animatedFadeInUp {
opacity: 0
}

.fadeInUp {
opacity: 0;
animation-name: fadeInUp;
-webkit-animation-name: fadeInUp;
}
</style>
</div>

<?php
print "<br>";
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

if (empty($muokattava)){
    header("Location:savecomment.php");
    exit;
}

//Muokataan kommentti
$sql="select * from team19_comment where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/tietuettaeiloydy.html");
    exit;
}
?>

<form action='./updatecomment.php' method='post'>
id:<br><input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br>
Username:<br><input type='text' name='username' value='<?php print $rivi->username;?>'><br>
Comment:<br><input type='text' name='message' value='<?php print $rivi->message;?>'><br><br>
<input type='submit' name='ok' value='OK'><br>
</form>

<?php
mysqli_close($yhteys);
?>

<footer>
	<p>© Cat Café Linna</p>
</footer>

</body>
</html>
