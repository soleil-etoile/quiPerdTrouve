<?php
//démarrage de la session
session_start();//toujours en haut

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titrePage; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Oswald|Raleway" rel="stylesheet">
    
    <!--links pour perdu3 test-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script> 
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/jquery-3.2.1.js"></script> 
    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/main.css">
    
    
</head>

<body>
    <div class="container-fluid">
        <header class="header row">
            <div class="col-md-3 col-xs-6">
                <img src="images/logo.png" alt="" class="img-responsive">
              
            </div>
            <div class="col-md-9 col-xs-6">
                <img src="images/logo.png" alt="logo Qui Perd-Trouve">
                <h1>Aidez vos objets à vous retrouver !</h1>
            </div> 
        </header>
        
        <?php 
        include "connexion.php"; // connexion BDD
        include "nav.php"; // menu de navigation
        
        ?>
        <main>
            
       
