<?php
session_start();
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


<!-- Jos käyttäjä ei ole kirjautunut, pyydetään kirjautumaan,
muussa tapauksessa päästetään vieraskirja-sivulle -->
<?php
if (!isset($_SESSION["kayttaja"])){
    ?>
    <div class="box">
    <?php
    echo "<p class='continue'>You are not logged in. To continue, please log in.</p>";
    print "<br>";
    echo "<a class='button' href='kirjauduajax.html'>Log in here!</a>";

    exit;
    ?>
    </div>
    <?php
}

else {
    ?>
    <script type="text/javascript">
    window.location.href = 'visitorsbook.php';
    </script>
    <?php
}
?>

</div>

<footer>
    <p>© Cat Café Linna</p>
</footer>

</body>
</html>