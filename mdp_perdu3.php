<?php
/* perdu3.php */
$titrePage = 'Qui perd, Trouve ! - Mot de passe perdu';
include 'includes/header.php';

//Mr propre (GET)
$safe = array_map('strip_tags', $_GET);
//récupération de l'ID dans la table abonnés
$stmtVerif = $dbh->prepare("SELECT id_annonceur
														FROM annonceurs
														WHERE token = :token"); //préparation
$paramVerif = array(':token' => $safe['token']); //paramètres
$stmtVerif->execute($paramVerif); //exécution
$exist = $stmtVerif->fetchColumn(); //une seule info
//si trouvé: formulaire MDP
if($exist !== false):
?>
	<form method="post" action="perdu4.php"
				class="col-md-offset-3 col-md-6">
		<div class="form-group">
			<label>nouveau mot de passe</label>
			<input type="password" name="mdp" class="form-control" />
			<input type="hidden" name="token" value="<?= $safe['token']; ?>" />
		</div>
		<!-- bouton submit -->
		<div class="form-group text-center">
			<input type="submit" name="btnsub" 
						 class="btn btn-boutons" value="Modifier" />
		</div>
</form>
<?php endif;
include 'includes/footer.php';
?>