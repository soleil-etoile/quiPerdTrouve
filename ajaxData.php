<?php
//Include database configuration file
include('connexion.php');

if(isset($_POST["id_pays"]) && !empty($_POST["id_pays"])){
    //Get all state data
    $query = $dbh->query("SELECT code_departement, nom_departement FROM villes_france_free WHERE id_pays = ".$_POST['id_pays']." ORDER BY nom_departement ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Afficher liste des departements
    if($rowCount > 0){
        echo '<option value="">Choisissez le departement</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['code_departement'].'">'.$row['nom_departement'].'</option>';
        }
    }else{
        echo '<option value="">Departement n\'est pas disponible</option>';
    }
}

if(isset($_POST["code_departement"]) && !empty($_POST["code_departement"])){
    //Recuperer les données des villes
    $query = $dbh->query("SELECT ville_id, ville_nom_reel FROM villes_france_free WHERE code_departement = ".$_POST['code_departement']." ORDER BY ville_nom_reel ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Choisissez la ville</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['ville_id'].'">'.$row['ville_nom_reel'].'</option>';
        }
    }else{
        echo '<option value="">Ville n\'est pas disponible</option>';
    }
}
?>