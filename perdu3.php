

<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';

?>
    
    
    
<div class="select-boxes">

<?php        
// Mr Proper (GET)
$safe = array_map('strip_tags', $_POST);

//Get all country data
$query = $dbh->query("SELECT id_pays, nom_fr_fr FROM pays ORDER BY nom_fr_fr");


//Count total number of rows
    $rowCount = $query->rowCount();
    ?>
    <select name="pays" id="pays" >
        <option value="">Choisissez le pays</option>
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
    
    <select name="departement" id="departement">
        <option value="">Select country first</option>
    </select>
    
    <select name="ville" id="ville">
        <option value="">Select state first</option>
    </select>
</div>





<?php
// requete annonces
$stmtObjets = $dbh->prepare("SELECT o.titre, o.photo, o.date_objet, l.lieu, v.ville_nom_reel, v.nom_departement, p.nom_fr_fr
                            FROM objets as o
                            JOIN lieu as l 
                            ON o.id_lieu = l.id_lieu
                            JOIN villes_france_free as v
                            ON o.id_ville = v.ville_id
                            JOIN pays as p
                            ON o.id_pays = p.id_pays
                            WHERE o.trouve_perdu = 2");

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
    echo '<section class="row">';
    foreach($listeObjets as $nb => $objet)
    {
        
        echo '<article class="col-md-8">
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
                        
                </article>
            </section>';
    }
} // fin if count > 0




require 'includes/footer.php';
?>