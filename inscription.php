<?php
/* Formulaire d'ajout d'un abonné */
$titrePage = "Qui perd,trouve ! - Inscription";
include "includes/header.php";
?>
<form method="post" action="ajoutAnnonceur.php"
			class="row">
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Nom</label>
		<input type="text" name="nom" class="form-control" 
					 placeholder="Votre nom" />
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Prénom</label>
		<input type="text" name="prenom" class="form-control" 
					 placeholder="Votre prénom"/>
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Pseudo</label>
		<input type="text" name="pseudo" class="form-control" 
					 placeholder="Votre Pseudo"/>
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Email</label>
		<input type="email" name="email" class="form-control" 
					 placeholder="Votre email"/>
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Mot de passe</label>
		<input type="password" name="mdp" class="form-control" 
					 placeholder = "8 caractères minimum dont une majuscule et un chiffre" />
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
		<label>Téléphone</label>
		<input type="text" name="telephone" class="form-control" 
		       placeholder="Votre téléphone"/>
	</div>
	<div class="form-group col-md-offset-2 col-md-8">
        <input type="checkbox" name="checkbox" required/>
        <label for="">J'accepte <a href="cdg.php">les conditions générales de vente de Qui perd, Trouve !</a></label>
    </div>
	<div class="form-group text-center">
		<button type="submit" name="btnSub" class=" btn-boutons" id="btn_inscrire"> 
		    <span class="btn_text">Je m'inscris</span>
        </button>
	</div>
	<div class="clearfix"></div>
</form>
<?php
require 'includes/footer.php';
?>
