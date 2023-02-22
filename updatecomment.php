<?php
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$username=isset($_POST["username"]) ? $_POST["username"] : "";
$message=isset($_POST["message"]) ? $_POST["message"] : "";

if (empty($id) || empty($username) || empty($message)){
    header("Location:./visitorsbook.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "root", "password", "userbase");
}
catch(Exception $e){
    header("Location:./visitorsbook.php");
    exit;
}

$sql="update comment set message=?, username=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ssi', $message, $username, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./visitorsbook.php");
?>