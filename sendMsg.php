<?php
// sendMsg.php
$titrePage = "Qui Perd, Trouve ! - Nous contacter";
require'includes/header.php';
//on va chercher la bibliothèque PHPMailer
require_once 'includes/phpmailer/PHPMailerAutoload.php';
//Mr Propre
$safe = array_map('strip_tags', $_POST);

/* création d'un objet mail et paramétrage */
$mail = new PHPMailer;
/* pour être sûr que ça passe (doc phpmailer) */
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isSMTP(); // connexion directe au serveur SMTP
$mail->isHTML(true); // utilisation du format HTML
$mail->Host = 'smtp.gmail.com'; // le serveur de messagerie
$mail->SMTPAuth = true; // on va fournir un login/password
$mail->Port = 465; // port utilisé par le serveur
$mail->SMTPSecure = 'ssl'; // certificat SSL
$mail->Username = 'quiperdtrouve.irza@gmail.com'; // le login SMTP
$mail->Password = 'projet2112'; // le mdp SMTP
$mail->AddAddress('quiperdtrouve.irza@gmail.com'); // destinataire
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