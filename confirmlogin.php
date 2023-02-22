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
    <link href="assets/css/style-kiia.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/css/images/logo.png">
    <title>Cat Café ✿ About us</title>
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

<?php
if (!isset($_SESSION["kayttaja"])){
    echo 'Et ole kirjautunut sisään. Kirjaudu, jotta voit jatkaa.';
    echo "<a href='kirjauduajax.html'>Kirjaudu sisään</a>";
    exit;
}
else {
    ?>
    <script type="text/javascript">
    window.location.href = 'visitorsbook.html';
    </script>
    <?php
}
?>

</body>
</html>