<?php
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "visitorsbook");
}
catch(Exception $e){
    header("Location:visitorsbook.php");
    exit;
}

if (!empty($message) || !empty($username)) {
    $sql = "insert into comment (message, username) values(?,?)";
    //Valmistellaan sql-lause
    $stmt = mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $message, $username);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);

    $last_id = mysqli_insert_id($yhteys);

    header("Location:visitorsbook.php");
    exit;
}
?>