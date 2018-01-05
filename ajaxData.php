<?php
//Include database configuration file
require('includes/database.php');

if(isset($_POST["id_pays"]) && !empty($_POST["id_pays"])){
    //Get all state data
    $query = $dbh->query("SELECT DISTINCT nom_departement, code_departement FROM villes_france_free WHERE id_pays = ".$_POST['id_pays']." ORDER BY nom_departement ASC");

   $listeDepartements = $query->fetchAll();
    
    //Afficher liste des departements
    if(count($listeDepartements) > 0){
        echo '<option value="">Choisissez le departement</option>';
        foreach($listeDepartements as $row){ 
            echo '<option value="'.$row['code_departement'].'">'.$row['nom_departement'].'</option>';
        }
    }else{
        echo '<option value="">Departement n\'est pas disponible</option>';
    }
}

if(isset($_POST["code_departement"]) && !empty($_POST["code_departement"])){
    //Recuperer les données des villes
    $query = $dbh->query("SELECT DISTINCT id_ville, ville_nom_reel FROM villes_france_free WHERE code_departement = ".$_POST['code_departement']." ORDER BY ville_nom_reel ASC");
    
    //Count total number of rows
    $listeVilles = $query->fetchAll();
    
    //Display cities list
    if(count($listeVilles) > 0){
        echo '<option value="">Choisissez la ville</option>';
        foreach($listeVilles as $row){ 
            echo '<option value="'.$row['id_ville'].'">'.$row['ville_nom_reel'].'</option>';
        }
    }else{
        echo '<option value="">Ville n\'est pas disponible</option>';
    }
}
?>