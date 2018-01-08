<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - Je depose une annonce";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';

//liste des catégories des objets
$stmtCat = $dbh->query('SELECT * FROM type_objet');
$listeCat = $stmtCat->fetchAll();
//liste des lieux
$stmtLieux = $dbh->query('SELECT * FROM lieux');
$listeLieux = $stmtLieux->fetchAll();

// liste des pays
$query = $dbh->query("SELECT id_pays, nom_fr_fr FROM pays ORDER BY nom_fr_fr");
//Count total number of rows
$rowCount = $query->rowCount();

//liste des options
$stmtOptions = $dbh->query('SELECT * FROM options_payantes');
$listeOptions = $stmtOptions->fetchAll();


//verification de connexion
if(isset($_SESSION['auth'])):
?>
<div class="row">    
    <div class="col-md-2">
            <sidebar class="pub">
                <h3>Publicités</h3>
                <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
                <?php require 'includes/pub_gauche2.php';?>
            </sidebar>   
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6">
        <h2>Je dépose une annonce</h2>       
        <form method="post" action="ajoutAnnonce.php" enctype="multipart/form-data">
            <div class="form-group class="input-group"">
                <label for="">Type d'annonce </label>
                <label class="renvoi"> *</label><br/>
                
                <input type="radio" id="jaitrouve" name="id_trouve_perdu" value="1"/>J'ai trouvé &nbsp;
                
                <input type="radio" id="jaiperdu" name="id_trouve_perdu" value="2"/>J'ai perdu
               
            </div>
            <div class="form-group">
                <label for="">Titre</label>
                <label class="renvoi"> *</label>
                <input type="text" name="titre" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Déscription</label>
                <label class="renvoi"> *</label>
                <textarea name="description" row="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Photo</label>
                <input type="file" name="photo" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Date de l'événement</label>
                <label class="renvoi"> *</label>
                <input type="date" id="datepicker" name="date_objet" class="form-control"  />
            </div>
            <div class="form-group form-row">
                <label for="">Recompense</label>
            </div>
            <div class="input-group">
                <input type="text" name="montant_recompense" required class="form-control currency" />
                <span class="input-group-addon">€</span>
            </div>
            <div class="form-group">
                <label for="">Catégorie</label>
                <label class="renvoi"> *</label>
                <select name="id_type" required class="form-control">
                    <option value="" selected disabled>Catégorie</option>
                    <?php foreach($listeCat as $cat): ?>
                    <option value="<?= $cat['id_type']; ?>"><?= $cat['type']; ?></option>    
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Lieux</label>
                <select name="id_lieu" class="form-control">
                    <option value="8" selected>Choisissez un lieu</option>
                    <?php foreach($listeLieux as $lieu): ?>
                    <option value="<?= $lieu['id_lieu']; ?>"><?= $lieu['lieu']; ?></option>    
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pays</label>
                <label class="renvoi"> *</label>
                <select name="pays" id="pays" required class="form-control">
                    <option value="" selected disabled>Pays</option>
                    <?php 
                    if($rowCount > 0){
                        while($row = $query->fetch()){ 
                        echo '<option value="'.$row['id_pays'].'">'.$row['nom_fr_fr'].'</option>';
                        }
                    }else{
                        echo '<option value="">Country not available</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group city-select">
                <label for="name" class="col-sm-2 control-label">Departement</label>
                <select class="form-control" name="departement" id="departement">
                <option value=""></option>
                </select>
            </div>
            <div class="form-group city-select">
                <label for="name" class="col-sm-2 control-label">Ville</label>
                <select class="form-control" name="ville" id="ville">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Remonter mon annonce en tête de liste</label><br/>
                <select name="options" class="form-control">
                    <option value="3" selected>Pour mettre en avant votre annonce, choisissez une option facultative.</option>
                    <?php foreach($listeOptions as $option): ?>
                    <option value="<?= $option['id_option']; ?>"><?= $option['detail_option']; ?></option>    
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="checkbox" name="checkbox" required/>
                <label for="">En cliquant sur le bouton "J'ajoute", je confirme avoir lu et accepte <a href="cdg.php">les conditions générales de vente de Qui perd, Trouve !</a></label>
            </div>
            
            
            <div class="form-group text-center">
                <input type="submit" class="btn btn-bibli" name="btnSub" value="J'ajoute" />
            </div>
            <label class="renvoi">* </label>
            <label class="label label-danger"> Champs obligatoires</label>

        </form>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
            <sidebar class="pub">
                <h3>Publicités</h3>
                <p>Ab velit occaecat philosophari ea commodo quae in voluptate consectetur, quibusdam instituendarum o nostrud, aute pariatur eiusmod. Litteris aliqua deserunt deserunt e nam appellat reprehenderit, multos ad voluptate, magna ad qui amet incurreret, ubi ea sunt quamquam, sunt doctrina coniunctione, </p>
                <?php require 'includes/pub_droite.php';?>
            </sidebar>   
    </div>
</div>
<div class="clearfix"></div>

<?php

else: ?>
    <br />
    <div>
       <img src="images/logo/veuillez-vous_connecter.png" alt="">
        <a href="connexion.php">Connectez-vous </a>pour déposer une annonce.
    </div>
    <?php endif; 
    
require 'includes/footer.php';
?>