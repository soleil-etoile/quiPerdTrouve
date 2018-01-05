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
    
    <!--links pour perdu test-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    
    <!-- les liens pour le calendrier avec jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
    <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script> 
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
     les liens pour le calendrier avec jQuery UI 
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--<script src="js/jquery-3.2.1.js"></script>--> 
    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>-->
    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
    <!--<script src="js/script.js"></script>-->
    <link rel="stylesheet" href="css/main.css">
    
    
</head>

<body>
    <div class="container-fluid">
        <header class="header row">
            <div class="col-md-3 col-xs-6">
                <img src="images/logo.png" alt="logo Qui Perd-Trouve" class="img-responsive" id="logo">              
            </div>
            <div class="col-md-9 col-xs-6">
                
                <h1>Aidez vos objets à vous retrouver !</h1>
            </div> 
        </header>
        
        <?php 
        require "database.php"; // connexion BDD
        require "nav.php"; // menu de navigation
        
        ?>
        <main>
            
       
