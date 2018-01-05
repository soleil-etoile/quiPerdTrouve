<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';

?>
    
    
    
<!--<div class="select-boxes">-->
<div class="container content">
        

<?php        
// Mr Proper (GET)
$safe = array_map('strip_tags', $_POST);

//Get all country data
$query = $dbh->query("SELECT id_pays, nom_fr_fr FROM pays ORDER BY nom_fr_fr");


//Count total number of rows
    $rowCount = $query->rowCount();
    ?>
    <form class="form-horizontal" method="post" id="form" action="perdu2.php">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Pays</label>
            <div class="col-sm-6">
                <select class="form-control" name="pays" id="pays" >
                    <option value="">Choisissez le pays</option>
                    <?php
                    if($rowCount > 0){
                        while($row = $query->fetch()){ 
                        if($row['nom_fr_fr'] == 'France') $select = 'selected';
                        else $select = ''; 
                            echo '<option value="'.$row['id_pays'].'" '.$select.'>'.$row['nom_fr_fr'].'</option>';
                        }
                    }else{
                        echo '<option value="">Country not available</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group city-select">
                <label for="name" class="col-sm-2 control-label">Departement</label>
                <div class="col-sm-6">
                    <select class="form-control" name="departement" id="departement">
                    </select>
                </div>
            </div>
            <div class="form-group city-select">
                <label for="name" class="col-sm-2 control-label">Ville</label>
                <div class="col-sm-6">
                    <select class="form-control" name="ville" id="ville">
                    </select>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" id="submit" name="btnSub" class="btn btn-primary">Choisir</button>
                </div>
            </div>
        </form>
        
        
        
    
    <!--<select name="departement" id="departement">
        <option value="">Select country first</option>
    </select>
    
    <select name="ville" id="ville">
        <option value="">Select state first</option>
    </select>-->
</div>





<?php
// requete annonces
$stmtObjets = $dbh->prepare("SELECT o.id_objet, o.titre, o.photo, o.date_objet, l.lieu, v.ville_nom_reel, v.nom_departement, p.nom_fr_fr
                            FROM objets as o
                            JOIN lieux as l 
                            ON o.id_lieu = l.id_lieu
                            JOIN villes_france_free as v
                            ON o.id_ville = v.id_ville
                            JOIN pays as p
                            ON o.id_pays = p.id_pays
                            WHERE o.id_trouve_perdu = 2");

// paramètres
$params = array();
// exécution
$stmtObjets->execute($params);
// récuperation
$listeObjets = $stmtObjets->fetchAll();
// controle
// print_r($listeObjets);

// aucun objet trouvé
if(count($listeObjets) == 0)
{
    echo '<div class="alert alert-warning">Aucun objet perdu</div>';
}
else
{
    echo '<section class="row-3">';
    foreach($listeObjets as $nb => $objet)
    {
        
        echo '<article class="col-md-3">
                <a href="annonce.php?id_objet='.$objet['id_objet'].'" class="lien_annonce">
                    <h3><strong>'.ucfirst($objet['titre']).'</strong></h3>';
        if(trim($objet['photo']) !== ''){
            echo '<img src="images/'.$objet['photo'].'" alt="'.$objet['titre'].'" 
                    class="img-responsive img-rounded photoObjet" />';
        }else{
            echo '<img src="images/no_photo.jpg" alt="no photo" 
                    class="img-responsive img-rounded photoObjet" />';
        }
        echo '       <ul>    
                            <li><strong>Date: </strong>'.dateFR($objet['date_objet']).'</li>
                            <li><strong>Lieu: </strong>'.ucfirst($objet['lieu']).'</li>
                            <li><strong>Localisation: </strong>'.ucfirst($objet['ville_nom_reel']).' / '.ucfirst($objet['nom_departement']).' / '.ucfirst($objet['nom_fr_fr']).'</li>
                        </ul>
                        <hr/>
                        
                </a>
            </article>
        </section>';
    }
} // fin if count > 0




require 'includes/footer.php';
?>