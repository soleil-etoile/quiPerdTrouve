<?php
// sendMsg.php
$titrePage = "Qui Perd, Trouve ! - Je contacte l'annonceur";
require'includes/header.php';
//on va chercher la bibliotheque PHPMailer
require_once 'includes/phpmailer/PHPMailerAutoload.php';
// Mr Propre
$safe = array_map('strip_tags', $_POST);

$query = $dbh->prepare("SELECT id_annonceur, email
                    FROM annonceurs
                    WHERE id_annonceur = :id_annonceur");
$params = array(':id_annonceur' => $safe['id_annonceur']);
// exécution
$query->execute($params);
// récuperation
$mailsAnnonceurs = $query->fetch();

// création d'un objet mail et paramétrage
$mail = new PHPMailer;

$mail->SMTPOptions = array('ssl' => 
                               array('verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => false));
$mail->isSMTP(); // connexion directe au serveur SMTP
$mail->isHTML(true); // utilisation du format HTML
$mail->Host = 'smtp.gmail.com'; // le serveur de messagerie
$mail->SMTPAuth = true; // on va fournir un login/password
$mail->Port = 465; // port utilisé par le serveur
$mail->SMTPSecure = 'ssl'; // certificat SSL
$mail->Username = 'quiperdtrouve.irza@gmail.com'; // le login SMTP
$mail->Password = 'projet2112'; // le mdp SMTP
$mail->AddAddress($mailsAnnonceurs['email']); // destinataire
$mail->SetFrom($safe['email']); // expediteur
$mail->Subject = 'Message de '.$safe['email']; // le sujet du mail
$mail->Body = '<html
                    <head>
                        <style>
                            h1{color: green;}
                        </style>
                    </head>
                    <body>
                        <h1>Message de '.$safe['email'].'</h1>
                        <p>'.' '.$safe['nom'].'</p>'.$safe['message'].'
                    </body>
                </html>'; // le contenu du mail en HTML
// si envoi OK

if($mail->send())
{
    echo '<div class="alert alert-success">Votre message a été envoyé.</div>';
}
//sinon
else
{
    echo '<div class="alert alert-danger">oupsss'.$mail->ErrorInfo.'</div>';
}


include 'includes/footer.php';
?>