<?php
$json=isset($_POST["user"]) ? $_POST["user"] : "";

if (!($user=tarkistaJson($json))){
    print "Täytä kaikki kentät";
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

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="insert into kayttaja (tunnus, salasana) values(?, SHA2(?, 256))";//sama kuin SHA2(?, 0)
try{
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->salasana);
    mysqli_stmt_execute($stmt);
    mysqli_close($yhteys);
    print "ok";
    exit;
}
catch(Exception $e){
    
}
?>

<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $user=json_decode($json, false);
    if (empty($user->tunnus) || empty($user->salasana)){
        return false;
    }
    return $user;
}
?>