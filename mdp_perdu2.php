<?php
/* perdu2.php */
$titrePage = "Qui Perd, Trouve - Mot de passe perdu";
require 'includes/header.php';

//Mr Propre
$safe = strip_tags($_POST['email']);
// ou $safe = array_map('strip_tags', $_POST);
//rechercher dans la table abonnes si email present
$stmtPerdu = $dbh->prepare("SELECT id_annonceur
														FROM annonceurs
														WHERE email = :email"); //préparation
$params = array(':email' => $safe); //paramètres
$stmtPerdu->execute($params); //exécution
$exist = $stmtPerdu->fetchColumn(); //une seule info
//si trouvé génération d'un token
if($exist !== false)
{
	$token = md5($safe.date('dmY')); // email + date jjmmaaaa
	// lien vers la page de récupération du mot de passe
	$link = 'http://'.$_SERVER['SERVER_NAME'].'/projet final/perdu-trouve/mdp_perdu3.php?token='.$token;
	//envoi du mail
	require_once 'includes/phpmailer/PHPMailerAutoload.php';
	$mail = new PHPMailer; 
	$mail->SMTPOptions = array('ssl' => 
														 array('verify_peer' => false,
														 			 'verify_peer_name' => false,
														 			 'allow_self_signed' => false));
	$mail->isSMTP(); //serveur SMTP direct
	$mail->isHTML(true); //format HTML
	$mail->Host = 'smtp.gmail.com'; //serveur SMTP
	$mail->SMTPAuth = true; //
	$mail->Port = 465; //port de messagerie
	$mail->SMTPSecure ='ssl'; //certificat SSL
	$mail->Username = 'wf3nimes@gmail.com'; //login SMTP
	$mail->Password = 'Azerty1234'; //mot de passe SMTP
	$mail->AddAddress($safe); //destinataire
	$mail->SetFrom('wf3nimes@gmail.com'); //expéditeur (idem username)
	$mail->Subject = 'QuiPerdTrouve - mot de passe perdu'; 
	$mail->Body = '<html>
									<head>
									<style>
									h1{color: red; }
									</style>
									</head>
									<body>
									<h1>Mot de passe perdu</h1>
									<p>Vous avez signalé votre mot de passe perdu.
									Veuillez cliquer sur le lien suivant pour le 
									réinitialiser.</p>
									<a href="'.$link.'">Réinitialiser le mot de passe</a>
									</body>
									</html>';
	//envoi raté?
	if(!$email->Send())
	{
		echo '<p class="alert alert-warning">Erreur Envoi: '
				 .$email->ErrorInfo
				 .'</p>';
	}
	//si mail envoyé
	else
	{
		//ajout du token
		$stmtToken = $dbh->prepare("UPDATE annonceurs
															 SET token = :token
															 WHERE id_annonceur = :id_annonceur");
		$paramToken = array(':token' => $token,
												':id_annonceur' => $exist);
		//si execution OK
		if($stmtToken->execute($paramToken))
		{
			echo '<p class="alert alert-success">
						Vérifiez votre boite mail</p>';
		}
		else echo '<p class="alert alert-danger">Oupssss</p>';
	}
} //fin exists !== 0
else echo '<p class="alert alert-warning">Adresse mail inconnue.</p>';

require 'includes/footer.php';
?>