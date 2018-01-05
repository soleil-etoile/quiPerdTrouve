<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';


// Mr Proper (GET)
$safe = array_map('strip_tags', $_POST);


function getCountries(){
	global $dbh;
	$query = "SELECT id_pays, nom_fr_fr FROM pays ORDER BY nom_fr_fr";
	/*$res = mysqli_query($dbh, $query);
	return mysqli_fetch_all($res, MYSQLI_ASSOC);*/
    $res = $dbh->query($query);
    return $res->fetchAll();     // exécute la requête
}

function getDepartements(){
	global $dbh;
	$id_pays = mysqli_real_escape_string($dbh, $_POST['id_pays']);
	$query = "SELECT code_departement, nom_departement 
            FROM villes_france_free
            WHERE id_pays = $id_pays";
	$res = $dbh->query($query);
	$data = '';
	while($row = $query->fetch_assoc()){
		$data .= "<option value='{$row['code_departement']}'>{$row['nom_departement']}</option>";
	}
	return $data;
}

function getCities(){
	global $dbh;
	$code_departement = mysqli_real_escape_string($dbh, $_POST['code_departement']);
	$query = "SELECT ville_id, ville_nom_reel 
            FROM villes_france_free
            WHERE code_departement = $code_departement";
	$res = $dbh->query($query);
	$data = '';
	while($row = $query->fetch_assoc()){
		$data .= "<option value='{$row['ville_id']}'>{$row['ville_nom_reel']}</option>";
	}
	return $data;

    
 /*   $safe = array_map('strip_tags', $_POST['code']);
    $stmtVilles = $dbh->prepare("SELECT id_pays, ville_id, ville_nom_reel FROM villes_france_free WHERE id_pays = :id_pays");
    $params = array(':id_pays' => $safe['pays']);
    $stmtVilles->execute($params);
    $listeVilles = $stmtVilles->fetchAll();
    while($row->fetchAll($stmtVilles)){
        $data .= "<option value='{$row['ville_id']}'>{$row['ville_nom_reel']}</option>";
    }
    return $data;*/
    
}

if(!empty($_POST['id_pays'])){
	echo getDepartements();
	exit;
}

if(!empty($_POST['code_departement'])){
	echo getCities();
	exit;
}

$countries = getCountries();

?>

	<div class="container content">
        <form class="form-horizontal" method="post" id="form">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Pays</label>
                <div class="col-sm-6">
                    <select class="form-control" name="country" id="country">
                        <option disabled selected>Choisissez le pays</option>
                        <?php foreach($countries as $country): ?>
                        <option value="<?=$country['id_pays']?>"><?=$country['nom_fr_fr']?></option>
                        <?php endforeach; ?>
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
                    <select class="form-control" name="city" id="city">
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" id="submit" class="btn btn-primary">Choisir</button>
                    <div></div>
                </div>
            </div>
        </form>
	</div>

<script>
$(function(){

	$('#country').change(function(){
		var id_pays = $(this).val();
		/*$('#city').load('perdu2.php', {id_pays: id_pays}, function(){
			$('.city-select').fadeIn('slow');
		});*/
        
        if(id_pays){
            $.ajax({
                type:'POST',
                url:'perdu2.php',
                data:'id_pays='+id_pays,
                success:function(html){
                    alert("ready");
                    $('#departement').html(html);
                    $('#city').html('<option value="">Select departement first</option>'); 
                }
            }); 
        }else{
            $('#departement').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select depart first</option>'); 
        }
	});
    
    $('#departement').change(function(){
        var code_departement = $(this).val();
        if(code_departement){
            $.ajax({
                type:'POST',
                url:'perdu2.php',
                data:'code_departement='+code_departement,
                success:function(html){
                    alert("city");
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });

});
	</script>

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