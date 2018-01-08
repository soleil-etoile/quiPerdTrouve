<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';

if(isset($_POST['btnSub']))
{
    //var_dump($_POST);
    if(isset($_POST['pays']) and $_POST['pays'] !== "")
    {
        // gestion de la page en cours
        if(isset($_GET['page']))
        {
            // Mr Proper
            $page = strip_tags($_GET['page']);
        }
        else 
        {
            $page = 1; // page 1 par défaut
        }
        /* nombre d'enregistrements */
        $stmt = $dbh->query("SELECT COUNT(*) 
                            FROM objets as o
                            LEFT JOIN lieux as l 
                            ON o.id_lieu = l.id_lieu
                            LEFT JOIN villes_france_free as v
                            ON o.id_ville = v.id_ville
                            LEFT JOIN pays as p
                            ON o.id_pays = p.id_pays
                            WHERE o.id_trouve_perdu = 2");
        $nbObjets = $stmt->fetchColumn();

        //var_dump($_POST);
        $safe = array_map('strip_tags', $_POST);
        
        // calcul du nombre de page
        $nbPages = intval($nbObjets / 8); // valeur entier
        if(($nbObjets % 8) > 0) $nbPages ++;

        // calcul de l'offset
        $offset = ($page -1) *8;

        // récuperation des annonces de la page actuelle
        $req = "SELECT o.id_objet, o.titre, o.photo, o.date_objet, l.lieu, v.ville_nom_reel, v.nom_departement, p.nom_fr_fr, v.code_departement, v.id_ville
                                FROM objets as o
                                LEFT JOIN lieux as l 
                                ON o.id_lieu = l.id_lieu
                                LEFT JOIN villes_france_free as v
                                ON o.id_ville = v.id_ville
                                LEFT JOIN pays as p
                                ON o.id_pays = p.id_pays
                                WHERE o.id_trouve_perdu = 2
                                AND o.id_pays = :id_pays";
        // concaténation des champs départements et villes si dans la recherche ces champs sont non renseignés.
        if($safe['departement'] !== '') $req .=" AND o.code_departement = :code_departement";
        if($safe['ville'] !== '') $req .=" AND o.id_ville = :id_ville";
        // concaténation pour afficher 8 annonces par page.
        $req .=" LIMIT ".$offset.",8";
        $stmtObjets = $dbh->prepare($req);
        $params = array(':id_pays' => $safe['pays']);
        if($safe['departement'] !== ''){
            $params[':code_departement'] = $safe['departement'];
        }
        if($safe['ville'] !== ''){
            $params[':id_ville'] = $safe['ville'];
        }
        //var_dump($params);
        // exécution
        $stmtObjets->execute($params);
        $listeObjets = $stmtObjets->fetchAll(PDO::FETCH_ASSOC);
        /*echo '<pre>';
        print_r($listeObjets);
        echo '<pre>';*/


        // liens de pagination
        echo '<ul class="pagination">';
        if($page >1) echo '<li>
                                <a href="perdu2.php?page='.($page-1).'">Précedent</a>
                            </li>';

        for($i=1; $i<=$nbPages; $i++)
        {
            $classe = '';
            if($i == $page) $classe = 'class="active"';
            echo '<li '.$classe.'><a href="perdu2.php?page='.$i.'">'.$i.'</a></li> ';
        }

        if($page < $nbPages) echo '<li><a href="perdu2.php?page='.($page+1).'">Suivant</a></li>';
        echo '</ul>';
 

        
        
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

                echo '<article class="col-md-2">
                        <a href="annonce_perdu.php?id_objet='.$objet['id_objet'].'" class="lien_annonce">
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
                        </article>';
                if(($nb !=0) AND (($nb+1)%4 ===0)) echo '<section class="row"></section>';
            } 
            echo '</section>';
        }// fin if count > 0
        
        // liens de pagination
        echo '<ul class="pagination">';
        if($page >1) echo '<li>
                                <a href="perdu2.php?page='.($page-1).'">Précedent</a>
                            </li>';

        for($i=1; $i<=$nbPages; $i++)
        {
            $classe = '';
            if($i == $page) $classe = 'class="active"';
            echo '<li '.$classe.'><a href="perdu2.php?page='.$i.'">'.$i.'</a></li> ';
        }

        if($page < $nbPages) echo '<li><a href="perdu2.php?page='.($page+1).'">Suivant</a></li>';
        echo '</ul>';

        

    } // fin isset id_pays
    
    else
    {
        echo '<img src="images/logo/error.png" />';
        echo '<a href="perdu.php" class="resultat">Merci d\'indiquer la localisation de la perte</a>'; 
    }
    
}// fin isset btnSub





require 'includes/footer.php';

?>