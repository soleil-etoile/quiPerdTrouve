<?php
$titrePage = "Qui Perd, Trouve - Accueil";
require "includes/header.php";
?>
<h2>Bienvenue sur notre site Qui Perd, Trouve !</h2>
<div class="container-fluid">
    <div class="col-md-2 col-xs-2">
        <sidebar class="pub">
            <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
        </sidebar>   
    </div>
    <div class="col-md-8 col-xs-8">
        <div class="lienscentraux">
            <button type="button" class="btn btn-lg btn-danger btn-boutons">
                <a href="perdu.php" class="boutons">J'ai perdu<br/> </a></button>
            <button type="button" class="btn btn-lg btn-warning btn-boutons">
                <a href="annonce.php" class="boutons">Je dépose<br/>une annonce</a></button><!--'i'm a rebel" ;)-->
            <button type="button" class="btn btn-lg btn-success btn-boutons">
                <a href="trouve.php" class="boutons">J'ai trouvé<br/> </a></button>
        </div>
    </div>
    <div class="col-md-2 col-xs-2">
        <sidebar class="pub">
            <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
        </sidebar>   
    </div>
</div>

<?php
require 'includes/footer.php';
?>

