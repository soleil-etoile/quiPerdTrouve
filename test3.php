<?php
require 'includes/header.php';

if($dbh)
{
    echo "connected";
}
else echo "fail to connect BDD";

$query=$dbh->query('SELECT p.nom_fr_fr, v.nom_departement, v.ville_nom_reel
    	                   FROM pays as p
                           JOIN villes_france_free as v
                           ON p.id_pays = v.id_pays');
$rowCount=$query->rowCount();
?>
<hr/>
<h3>Pays</h3>
<hr/>
<select name="nom_fr_fr" id="pays">
    <option value="">Choisir pays</option>
    <?php
    if($rowCount>0)
    {
        while($row=$query->fetch())
        {
            echo '<option value="'.$row['id_pays'].'">'
                .$row['nom_fr_fr'].'</option>';
        }
    }
    else
    {
        echo '<option value=""> Pays non trouvé</option>';
    }
    
    
    
    ?>
    
    
</select>

<select name="nom_departement" id="departement">
    <option value="">Choisir departement</option>
    <?php
    if($rowCount>0)
    {
        while($row=$query->fetch())
        {
            echo '<option value="'.$row['code_departement'].'">'
                .$row['nom_departement'].'</option>';
        }
    }
    else
    {
        echo '<option value=""> Departement non trouvé</option>';
    }
?>  
    
</select>

<select name="ville_nom_reel" id="ville">
    <option value="">Choisir ville</option>
    <?php
    if($rowCount>0)
    {
        while($row=$query->fetch())
        {
            echo '<option value="'.$row['ville_id'].'">'
                .$row['ville_nom_reel'].'</option>';
        }
    }
    else
    {
        echo '<option value=""> Ville non trouvée</option>';
    }
?>  
    
</select>


<?php
require 'includes/footer.php';
?>
