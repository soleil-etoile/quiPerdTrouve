<?php
/* ajoutAbonne.php */
$titrePage = "Qui Perd, trouve ! - Inscription";
include "includes/header.php";
// boite à outils pour vérifier le mot de passe
include "includes/toolbox.php";

if(isset($_POST['btnSub']))
{
	//Mr propre (pour les attaques XSS)
	$safe = array_map('strip_tags', $_POST);
	//vérifier format email
	if(filter_var($safe['email'],FILTER_VALIDATE_EMAIL))
	{
		//vérifier format mot de passe
		if(verifPass($safe['mdp']))
		{
			// vérifier si l'email n'est déjà dans la table
			$stmt2 = $dbh->prepare("SELECT COUNT(*) 
									FROM annonceurs
									WHERE email = :email");
			//paramètres
			$param2 = array(':email' => $safe['email']);
			//exécution
			$stmt2->execute($param2);
			//récupération
			$exists = $stmt2->fetchColumn();
			// si email absent
			if($exists == 0)
			{	
				if(isset($_POST['checkbox']))
                {
                    // préparation requete
                    $stmt = $dbh->prepare("INSERT INTO annonceurs(pseudo, mdp,nom, prenom, email,telephone) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :telephone)");
                    //hashage mot de passe
                    $hash = password_hash($safe['mdp'], PASSWORD_DEFAULT);
                    // paramètres
                    $params = array(':pseudo' => $safe['pseudo'],
                                    ':mdp' => $hash,
                                    ':nom' => $safe['nom'],
                                    ':prenom' => $safe['prenom'],
                                    ':email' => $safe['email'],
                                    ':telephone' => $safe['telephone']
                                    );
                    //exécution
                    if($stmt->execute($params))
                    {
                        //c'est OK!
                        echo '<script>	window.location.replace("connexion.php");
				        </script>';
                        echo '<div class="alert alert-success">
                                    Merci pour votre inscription.
                                    </div></div>';
                    } // fin execute
                    else echo '<div class="alert alert-danger">oups</div>'; 
                }
                else echo '<script>alert("Merci d\'accepter les conditions générale de notre site Qui Perd, Trouve !");
                window.location.href = "inscription.php"</script>';
			} // fin $exists == 0
			else echo '<div class="alert alert-danger">Adresse mail déjà présente.</div>';
		} // fin test mdp
		else echo '<div class="alert alert-danger">Mot de passe non conforme.</div>';
	} //fin test email
	else echo '<div class="alert alert-danger">Email non valide.</div>';
} //fin test bouton
else echo '<div class="alert alert-danger">il faut passer par le formulaire.</div>';
include "includes/footer.php";

?>