<?php
require 'includes/header.php';


if(isset($_POST['code_departement']))
{
    $id   = $_POST['code_departement']; 
}
if(isset($_POST['type']))
{
    $type = $_POST['type']; 
}
else $type="departement";


if ($type == 'ville') {
	// choix de ville dans le liste des departement
	$result = $dbh->query('SELECT ville_nom_reel
    	                   FROM villes_france_free
    	                   WHERE code_departement = '.$id.'
    	                   ORDER BY ville_nom_reel')->fetchAll();
	if (!empty($result)) {
		echo "out.options[out.options.length] = new Option('выберите город...','none');\n";
		foreach($result as $ville) {
			echo "out.options[out.options.length] = new Option('".$ville['ville_nom_reel']."','".$ville['ville_id']."');\n";
		}
	}
	else {
		echo "out.options[out.options.length] = new Option('нет городов','none');\n";
	}
}
if ($type == 'departement') {
	// choix du departement dans le liste des pays
	$result2 = $dbh->query('SELECT nom_departement, code_departement
    	                    FROM villes_france_free
    	                    WHERE id_pays = 75
    	                    ORDER BY nom_departement')->fetchAll();
	if (!empty($result2)) {
		echo "out.options[out.options.length] = new Option('выберите регион...','none');\n";
		foreach($result2 as $departement) {
			echo "out.options[out.options.length] = new Option('".$departement['nom_departement']."','".$departement['code_departement']."');\n";
		}
	}
	else {
		echo "out.options[out.options.length] = new Option('нет регионов','none');\n";
	}
}
?>

    