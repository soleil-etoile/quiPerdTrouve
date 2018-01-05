<?php
/* connexion.php */
$titrePage = "Qui perd, trouve !- Je me connecte";
include 'includes/header.php';
?>
<form method="post" action="login.php"
			class="col-md-offset-3 col-md-6">
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" placeholder="adresse mail"
					 class="form-control" />
	</div>
	<div class="form-group">
		<label>Mot de passe</label>
		<input type="password" name="mdp" class="form-control"
					 placeholder="8 caractères mini dont 1 maj et 1 nbr" />
	</div>
	<div class="form-group text-center">
		<input type="submit" name="btnSub" value="Entrer"
					 class="btn btn-bibli" />
	</div>
	<div class="text-center">
		<a href="mdp_perdu.php">Mot de passe perdu</a>
	</div>
</form>
<?php
include 'includes/footer.php';
?>