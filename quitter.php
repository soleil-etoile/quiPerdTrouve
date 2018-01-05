<?php
//quitter.php
session_start();
//destruction des variables de session
session_unset();
//destruction de la session
session_destroy();
//redirection url en PHP
header('location:index.php');
?>