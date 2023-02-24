<?php
session_start();
?>
<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Maija Nevalainen, Kiia Kuokkala, Nanna Santakangas">
    <meta name="description" content="cat cafe, visitor's book">
    <meta name="keywords" content="cats, cat, cute, tasty, drinks, snacks, hämeenlinna, hameenlinna, kitten, coffee, cafe, café">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style-login.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/css/images/logo.png">
    <title>Cat Café ✿ Visitor's book</title>
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

    <!-- Lähetetään käyttäjä visitorsbook-sivulle jos ei ilmene virheitä -->
    <script>
        function lahetaKayttaja(){
        xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
        if (this.responseText=="ok"){
		    	window.location.assign("/visitorsbook.html");
		    }
        }
        xmlhttp.open("POST", "/confirmlogin.php", true);
	    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xmlhttp.send("user=" + jsonUser);
        }
    }
    </script>
    <!-- Sivun animaatio -->
        <div class="animated animatedFadeInUp fadeInUp">
        <div class="box">

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

    <!-- Vieraskirjan lomake -->
    <h1>Visitor's book</h1>
    <form action="savecomment.php" method="POST">
        Username: <br><input type="text" name="username"><br><br>
        Comment: <br><textarea name="message"></textarea><br><br>
        <input type="submit" value="post comment">
    </form>

    </div>
    </div>


    <?php
    //Ilmaistaan käyttäjätyyppi (user/admin)
    $sql = "select kayttaja.usertype from kayttaja where tunnus='".$_SESSION['kayttaja']."'";
    $result = mysqli_query($yhteys, $sql);
    $usertype = mysqli_fetch_array($result);
    $_SESSION['usertype'] = $usertype['usertype']; 

    //Tulostetaan vieraskirjan viestit taulukkoon
    print "<br><br>";
    print "<table border='1'>";
    $tulos=mysqli_query($yhteys, "select * from comment order by id");
    //Jos käyttäjä on kirjautunut adminina, annetaan oikeus poistaa ja muokata viestejä
    if ($_SESSION["usertype"]=='admin') {
        while ($rivi=mysqli_fetch_object($tulos)){
            print "<tr><td>$rivi->username";
            print "<tr><td>$rivi->message";
            print "<td><a href='./deletecomment.php?poistettava=$rivi->id'>Delete</a>";
            print "<td><a href='./editcomment.php?muokattava=$rivi->id'>Edit</a>";
        }
    } else {
        while ($rivi=mysqli_fetch_object($tulos)){
            print "<tr><td>$rivi->username";
            print "<tr><td>$rivi->message";
        }
    }

    print "</table>";
    mysqli_close($yhteys);
    ?>

    <footer>
        <p>© Cat Café Linna</p>
    </footer>

</body>
</html>