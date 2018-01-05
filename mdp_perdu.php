<?php 
/* perdu.php */
$titrePage = 'Qui perd, Trouve ! - Mot de passe perdu';
include 'includes/header.php';
?>
<form method="post" action="mdp_perdu2.php"
			class="col-md-offset-3 col-md-6" >
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" />
	</div>
	<div class="form-group text-center">
		<input type="submit" name="btnSub" value="Envoyer" 
					 class="btn btn-boutons" />
	</div>
</form>
<?php
include 'includes/footer.php';
?>