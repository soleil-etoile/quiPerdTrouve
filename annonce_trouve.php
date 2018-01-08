<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai trouvé";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';
?>
<div class="container-fluid">
    <div class="col-md-2 col-xs-2">
        <sidebar class="pub">
            <?php
            require 'includes/pub_gauche.php';
            ?>
        </sidebar>   
    </div>

<?php
$safe = array_map('strip_tags', $_GET);
        $stmtObjets = $dbh->prepare("SELECT o.titre, o.photo, o.date_objet, o.montant_recompense, o.description, o.id_annonceur, l.lieu, v.ville_nom_reel, v.nom_departement, p.nom_fr_fr
                                FROM objets as o
                                LEFT JOIN lieux as l 
                                ON o.id_lieu = l.id_lieu
                                LEFT JOIN villes_france_free as v
                                ON o.id_ville = v.id_ville
                                LEFT JOIN pays as p
                                ON o.id_pays = p.id_pays
                                WHERE o.id_trouve_perdu = 1
                                AND o.id_objet = :id_objet");

        // paramètres
        $params = array(':id_objet' => $safe['id_objet']);
        // exécution
        $stmtObjets->execute($params);
        // récuperation
        $listeObjets = $stmtObjets->fetchAll();
        // controle
        // print_r($listeObjets);

        // aucun objet trouvé
        if(count($listeObjets) == 0)
        {
            echo '<div class="alert alert-warning">Aucun objet trouvé</div>';
        }
        else
        {
            echo '<section class="row-3">';
            foreach($listeObjets as $objet)
            {
                echo '<article class="col-md-7 text-justify detail_annonce">
                        
                            <h2><strong>'.ucfirst($objet['titre']).'</strong></h2>';
                if(trim($objet['photo']) !== ''){
                    echo '<img id="image_annonce" src="images/'.$objet['photo'].'" alt="'.$objet['titre'].'" 
                            class="img-responsive img-rounded photoObjet" />';
                }else{
                    echo '<img src="images/no_photo.jpg" alt="no photo" 
                            class="img-responsive img-rounded photoObjet" />';
                }
                echo '       <ul class="liste_annonce">    
                                    <li><strong>Date: </strong>'.dateFR($objet['date_objet']).'</li>
                                    <li><strong>Lieu: </strong>'.ucfirst($objet['lieu']).'</li>
                                    <li><strong>Localisation: </strong>'.ucfirst($objet['ville_nom_reel']).' / '.ucfirst($objet['nom_departement']).' / '.ucfirst($objet['nom_fr_fr']).'</li>
                                    <li><strong>Description: </strong>'.ucfirst($objet['description']).'</li>
                                    <li><strong>Récompense: </strong>'.ucfirst($objet['montant_recompense']).' €</li>
                                </ul>
                                <hr/>

                        </article>
                        
                    </section>';
            }
            
        }// fin if count > 0

?>

    

<div class="col-md-3">
    <form action="mailAnnonceur.php" method="post" class="detail_annonce">
        <legend>Contacter l'annonceur par e-mail</legend>
        <div class="form-group">
            <label>Nom:</label>
            <input type="hidden" name="id_annonceur" value="<?= $objet['id_annonceur']; ?>" />
            <input type="text" name="nom" class="form-control" 
                         placeholder="Votre nom" required/>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" 
                         placeholder="Votre email" required/>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea name="message" row="5" class="form-control" placeholder="Votre message" required></textarea>
        </div>
        
        <div class="form-group text-center">
            <button type="submit" name="btnSub" class="btn btn-boutons btn_contact_annonceur">
                <span class="btn_text">J'envoie</span>
            </button>	
	</div>
    </form>
</div>

    


<?php
require 'includes/footer.php';
?>