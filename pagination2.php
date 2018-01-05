<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';

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
    
    // nombre d'enregistrements
    $stmt = $dbh->query("SELECT COUNT(*) FROM objets");
    $nbObjets = $stmt->fetchColumn();
    
    // calcul du nombre de page
    $nbPages = $nbObjets / 5; // valeur entier
    if(($nbObjets % 5) > 0) $nbPages ++;
    
    // calcul de l'offset
    $offset = ($page -1) *5;
    
    // récuperation des livres de la page actuelle
    $req = "SELECT titre, date_objet, id_lieu, id_ville, code_departement, id_pays FROM objets LIMIT ".$offset.", 8";
    
    $stmt2 = $dbh->query($req);
    $listeObjets = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($listeObjets);
    echo '<pre>';
    
    // liens de pagination
    if($page >1) echo '<a href="pagination.php?page='.($page-1).'">Précedent</a> ';
    
    for($i=1; $i<=$nbPages; $i++)
    {
        echo '<a href="pagination.php?page='.$i.'">'.$i.'</a> ';
    }
    
    if($page < $nbPages) echo '<a href="pagination.php?page='.($page+1).'">Suivant</a>';
    

require 'includes/footer.php';
    ?>
    






