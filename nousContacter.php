<?php
/* contact.php */
$titrePage = "Qui Perd, Trouve ! - Nous contacter";
require'includes/header.php';

/* si connecté on remplit les champs automatiquement */
if(isset($_SESSION['auth']))
{
    $nom = $_SESSION['pseudo'];
    
    $email = $_SESSION['email'];

}
else
{
     $nom = $email = '';
}

?>
<form method="post" action="sendMsg.php"
            class="col-md-offset-3 col-md-6">
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="nom" value="<?= $nom; ?>"
                     class="form-control" />
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= $email; ?>" 
               class="form-control"/>
    </div>
    <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group text-center">
        <input type="submit" value="Envoyer" name="btnSub"
                     class="btn btn-bibli" />
    </div>
</form>
<?php
include 'includes/footer.php';
?>