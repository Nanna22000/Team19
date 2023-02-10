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
    <title>Cat Café ✿ Visitor's book</title>
</head>
<body>
    <header>
        <div class="topnav">
            <a class="active" href="index.html">Home</a>
            <a href="aboutus.html">About us</a>
            <a href="menu.html">Menu</a>
            <a href="cats.html">Our cats</a>
            <a href="visitorsbook.php">Visitor's book</a>
        </div> 
    </header>

    <h1>Visitor's book</h1>
    <form action="visitorsbook.html" method="POST">
        First name: <input type="text" name="fname"><br>
        Last name: <input type="text" name="lname"><br>
        Comment: <textarea name="comment"></textarea><br>
        <input type="submit" value="post comment">
    </form>

    <?php

    ?>

    <footer>
        <p>© Cat Café Linna</p>
    </footer>
</body>
</html>