<?php
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$username=isset($_POST["username"]) ? $_POST["username"] : "";
$message=isset($_POST["message"]) ? $_POST["message"] : "";

//Jos jokin kentistä on tyhjä, viedään käyttäjä takaisin visitorsbook-sivulle
if (empty($id) || empty($username) || empty($message)){
    header("Location:./visitorsbook.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

//Luodaan yhteys tietokantaan
try{
    $yhteys=mysqli_connect("db", "root", "password", "userbase");
}
catch(Exception $e){
    header("Location:./visitorsbook.php");
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