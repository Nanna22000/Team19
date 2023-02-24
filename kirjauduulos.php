<?php
session_start();
// unset($_SESSION["kayttaja"]);
session_destroy();
session_write_close();
header("Location:/kirjauduajax.html");
// die;
?>