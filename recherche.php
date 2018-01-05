<?php
require 'includes/header.php';
require 'includes/toolbox.php';

$query = $_POST['query'];
$min_length = 3;
if(!empty($query)) 
{
    // Si la taille d'une chaîne est plus que 3
    if(strlen($query) >= $min_length)
    {
        // Convertit les caractères spéciaux en entités HTML
        $query = htmlspecialchars($query);
        // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $query = trim($query);
        // supprime les balises HTML et PHP d'une chaine
        $query = strip_tags($query);
        
    
        $stmt = $dbh->prepare('SELECT * FROM objets as o
                        LEFT JOIN type_objet as t
                        ON o.id_type = t.id_type
                        LEFT JOIN lieux as l
                        ON o.id_lieu = l.id_lieu
                        LEFT JOIN pays as p
                        ON o.id_pays = p.id_pays
                        LEFT JOIN villes_france_free as v
                        ON o.id_ville = v.id_ville
                        WHERE o.titre LIKE :keyword 
                        OR o.description LIKE :keyword
                        OR t.type LIKE :keyword 
                        OR l.lieu LIKE :keyword 
                        OR p.nom_fr_fr LIKE :keyword 
                        OR v.ville_nom_reel LIKE :keyword');
        $stmt->bindValue(':keyword', '%' . $query . '%', PDO::PARAM_STR);
        //print_r($stmt);
        $stmt->execute();
        $result = $stmt->fetchAll();
        /*echo '<pre>';
        print_r($result);
        '</pre>';*/
        echo '<section class="row">';
        foreach($result as $nb => $objet)

        {
                echo '<article class="col-md-2">
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
                    </article>';
            if(($nb !=0) AND (($nb+1)%4 ===0)) echo '</section><section class="row">'; 
        } // fin foreach
    }
    else 
    {
        echo '<p class="resultat">Veuillez saisir plus de caractéres.</p>';
        echo '<img src="images/logo/inscrire.png" />';
        
    }
	
}
else 
{
    echo '<p class="resultat">Aucun mot clés n\'a été saisi.</p>';
    echo '<img src="images/logo/vide.png" />';
}

require 'includes/footer.php';
?>

