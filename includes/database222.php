<?php
/* connexion à la base de données */
$dbh = new PDO('mysql:host=localhost;dbname=lostfound;charset=utf8',
							 'lostfound', 'perdutrouve');
//mode debug
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//tableaux associatifs par defaut
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>