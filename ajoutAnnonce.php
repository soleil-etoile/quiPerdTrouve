<?php
// depotAnnonce.php
//session_start();
$titrePage = "Qui Perd, Trouve ! - Je dépose une annonce";
require 'includes/header.php';
//boite à outils (pour les dates)
require 'includes/toolbox.php';
/*print_r($_POST);*/

 if(isset($_POST['btnSub']) && !empty($_POST['btnSub']))
{
    // si on a choisi est-c'est que ce perdu ou trouvé
    if(isset($_POST['id_trouve_perdu']))
    {
        // si le CGV sont acentées
        if(isset($_POST['checkbox']))
        {
            $radio_input = $_POST['id_trouve_perdu'];

            // on teste l'erreur sur le transfert
            if($_FILES['photo']['error'] > 0)
            {
                $photo = "no_photo.jpg";
            }
            else
            {
                // récupération de la photo

                // controle type mime
                $info = new finfo(FILEINFO_MIME_TYPE);
                $mime = $info->file($_FILES['photo']['tmp_name']);
                if(substr($mime, 0, 6) == 'image/')
                {
                    // création nom aléatoire
                    $extension = substr($_FILES['photo']['name'], -4);
                    $nom = md5(uniqid(rand(), true));
                    $photo = $nom.$extension;
                    // copie de l'image
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
                } // fin du if type mime
            } // fin if $_FILES

            // Mr Propre
            $safe = array_map('strip_tags', $_POST);

            // preparation
            $stmtAnnonce = $dbh->prepare("INSERT INTO objets (id_trouve_perdu, titre, description, photo, date_objet, montant_recompense, id_annonceur, id_type, id_lieu, id_pays, code_departement, id_ville, id_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if($safe['id_lieu'] == '') $safe['id_lieu'] = NULL;
            if($safe['departement'] == '') $safe['departement'] = NULL;
            if($safe['ville'] == '') $safe['ville'] = NULL;
            // parametres
            $params = array(
                            $safe['id_trouve_perdu'],            
                            $safe['titre'],
                            $safe['description'],
                            $photo,
                            $safe['date_objet'],
                            $safe['montant_recompense'],
                            $_SESSION['id_annonceur'],
                            $safe['id_type'],
                            $safe['id_lieu'],
                            $safe['pays'],
                            $safe['departement'],
                            $safe['ville'],
                            $safe['options']                        
                            );
            
            // exécution
            $stmtAnnonce->execute($params);
            //var_dump($params);
            // retour
            echo '<img src="images/logo/ok.png" />';
            echo '<a href="index.php" class="resultat">Votre annonce a été mise en ligne.</a>';



                } else echo '<script>alert("Merci d\'accepter les conditions générale de notre site Qui Perd, Trouve !");
                window.location.href = "depotAnnonce.php"</script>';
            }
       else  
        {
           echo '<script>alert("Merci d\'indiquer dans le formulaire de depot s\'il s\'agit d\'un objet perdu ou trouvé.");
            window.location.href = "depotAnnonce.php"</script>';
        }
}


require 'includes/footer.php';
?>