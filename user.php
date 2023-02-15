<?php

include '.ht.asetukset.ini';

session_start();

$user_id = $_SESSION['kayttaja_id'];

if(!isset($user_id)){
   header('location:kirjauduajax.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Käyttäjä sivu</title>

</head>
<body>

<h1 class="title"> <span>user</span> Profiili sivu </h1>

<section class="profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `kayttaja` WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <div class="profile">
      <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <h3><?= $fetch_profile['name']; ?></h3>
      <a href="user_profile_update.php" class="btn">Päivitä profiili</a>
      <a href="logout.php" class="delete-btn">Kirjaudu ulos</a>
      <div class="flex-btn">
         <a href="kirjauduajax.html" class="option-btn">Kirjaudu</a>
         <a href="rekisteroidyajax.html" class="option-btn">Rekisteröidy</a>
      </div>
   </div>

</section>

</body>
</html>