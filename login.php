<?php
/* login.php */
session_start(); //toujours en haut
//bouton cliqué?
if(isset($_POST['btnSub']))
{
	//Mr Propre!!!
	$safe = array_map('strip_tags', $_POST);
	//email valide?
	if(filter_var($safe['email'], FILTER_VALIDATE_EMAIL))
	{
		//include toolbox
		require 'includes/toolbox.php';
		// mot de passe conforme?
		if(verifPass($safe['mdp']))
		{
			//include database
			require 'includes/database.php';
			//préparation
			$stmt = $dbh->prepare("SELECT id_annonceur, pseudo, nom, prenom, mdp, email
									FROM annonceurs
									WHERE email = :email");
			//paramètres
			$params = array(':email' => $safe['email']);
			//exécution
			$stmt->execute($params);
			//récupération
			$annonceur = $stmt->fetch();
			// pour le controle
			//print_r($annonceur);
			// controle validité mot de passe	
			if(password_verify($safe['mdp'], $annonceur['mdp']))
			{
				echo 'Eureka!';
				//traitement si password reconnu
				$_SESSION['id_annonceur'] = $annonceur['id_annonceur'];
				$_SESSION['pseudo'] = $annonceur['pseudo'];
				$_SESSION['email'] = $safe['email'];
				$_SESSION['auth'] = 'ok';
				//SECURITE!!!
				session_regenerate_id();
				//redirection
				echo '<script>
						alert("Bonjour '
						.$annonceur['prenom']
						.'");
						window.location.replace("index.php");
						</script>';
			}	
			else echo 'mot de passe incorrect';
		} // fin verifPass
		else echo 'mot de passe invalide';
	} //fin verif email
	else echo 'email invalide';
} //fin isset btn
else echo 'Merci de passer par le formulaire inscription';

?>