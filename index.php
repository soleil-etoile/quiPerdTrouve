<?php
$titrePage = "Qui Perd, Trouve - Accueil";
require "includes/header.php";
?>
<h2>Bienvenue sur notre site Qui Perd, Trouve !</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-xs-2">
            <sidebar class="pub">
                <h3>Publicités</h3>
                <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
                <?php require 'includes/pub_gauche.php';?>
            </sidebar>   
        </div>
        <div class="col-md-8 col-xs-8">
            <div class="lienscentraux">
                   
                <div>
                    <a href="perdu.php" class="boutons" >
                        <div id="btn_perdu" class="btn_buttons">J'ai perdu</div>
                    </a>
                </div>
                <div> 
                    <a href="depotAnnonce.php" class="boutons">
                        <div id="btn_annonce" class="btn_buttons">Je dépose<br/>une annonce</div>
                    </a><!--'i'm a rebel" ;)-->
                </div>
                <div>
                    <a href="trouve.php" class="boutons">
                        <div id="btn_trouve" class="btn_buttons">J'ai trouvé</div>
                    </a>
                </div>
                
            </div>
            
        </div>
        
        
        
        
        
        
        
        
        <div class="col-md-2 col-xs-2">
            <sidebar class="pub">
                <h3>Publicités</h3>
                <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
                <?php require 'includes/pub_droite.php';?>
            </sidebar>   
        </div>
    </div>
</div>

<?php
require 'includes/footer.php';
?>

