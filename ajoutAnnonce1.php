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

//verification de connexion
if(isset($_SESSION['auth'])):
?>    

    <div class="col-md-8">
        <h2>Je dépose une annonce</h2>       
        <form method="post" action="ajoutAnnonce.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Type d'annonce</label><br/>
                
                <input type="radio" id="jaitrouve" name="id_trouve_perdu" value="1"/>J'ai trouvé &nbsp;
                
                <input type="radio" id="jaiperdu" name="id_trouve_perdu" value="2"/>J'ai perdu
                <?php
                if(isset($_POST['id_trouve_perdu']))
                {
                    $_POST['id_trouve_perdu'];
                }
                
                ?>
            </div>
            <div class="form-group">
                <label for="">Titre</label>
                <input type="text" name="titre" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Déscription</label>
                <textarea name="description" row="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Photo</label>
                <input type="file" name="photo" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Date de l'événement</label>
                <input type="date" id="datepicker" name="date_objet" class="form-control"  />
            </div>
            <!--<div class="form-row">
                <label for="c2">Currency w bootstrap</label>
                <div class="input-group"> 
                    <span class="input-group-addon">$</span>
                    <input type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
            </div> -->
            <div class="form-group form-row">
                <label for="">Recompense</label>
            </div>
            <div class="input-group">
                
                <input type="text" name="montant_recompense" required class="form-control currency" />
                <span class="input-group-addon">€</span>
            </div>
            <div class="form-group">
                <label for="">Catégorie</label>
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
                <select class="form-control" name="ville" id="ville"></select>
            </div>
<!--
            <div class="form-group">
                <input type="checkbox" name="select_option" />
                <label for="">Remonter mon annonce en tête de liste</label><br/>
             
                <div>    
                    <input type="radio" id="option1" name="options" value="1"/>Chaque jour pendant 60 jours pour 2.99€ TTC &nbsp;
                    <input type="radio" id="option2" name="options" value="2"/>Chaque jour pendant 90 jours pour 4.99€ TTC
                </div>               
                
            </div>
-->
            <div class="form-group">
                <div class="multiselect">Remonter mon annonce en tête de liste
                    <div class="selectBox" onclick="showCheckboxes()">
                        <select>
                        <option>Veuillez choisir une option.</option>
                        </select>
                  <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                    <label for="Option 1">
                    <input type="checkbox" id="one" />Chaque jour pendant 60 jours pour 2.99€ TTC &nbsp;</label>
                    <label for="Option 2">
                    <input type="checkbox" id="two" />Chaque jour pendant 90 jours pour 4.99€ TTC</label>

                </div>
            </div>
            
            <div class="form-group text-center">
                <input type="submit" class="btn btn-bibli" name="btnSub" value="J'ajoute" />
            </div>

        </form>
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