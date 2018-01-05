<?php 
/* perdu4.php */
$titrePage = 'Qui Perd, Trouve ! - Mot de passe perdu';
include 'includes/header.php';
include 'includes/toolbox.php'; //pour la vérification mdp

//Mr Propre
$safe = array_map('strip_tags', $_POST);
//vérification mdp
if(verifPass($safe['mdp']))
{
	//connexion
	include 'includes/database.php';
	//mise à jour MDP + token
	$stmtMdp = $dbh->prepare("UPDATE annonceurs
														SET mdp = :mdp, token='' 
														WHERE token = :token"); //préparation
	$hash = password_hash($safe['mdp'], PASSWORD_DEFAULT);
	$params = array(':mdp' => $hash, 
								  ':token' => $safe['token']); //paramètres
	//exécution
	if($stmtMdp->execute($params))
	{
		echo '<p class="alert alert-success">Votre mot de passe a été mis à jour.</p>';
	}
	else
	{
		echo '<p class="alert alert-danger">Mot de passe non mis à jour</p>';
	}
} //fin verifPass
else 
{
	echo '<p class="alert alert-danger">Mot de passe invalide!</p>';
}

include 'includes/footer.php';
?>