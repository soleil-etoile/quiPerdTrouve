<?php
/* connexion à la BDD */
$dbh = new PDO('mysql:host=localhost;dbname=lost;charset=utf8', 'lost', 'perdutrouve');

// mode debug 
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//tableaux associatifs par defaut
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>