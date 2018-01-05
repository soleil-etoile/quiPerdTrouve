<?php
// perdu.php
$titrePage = "Qui Perd, Trouve ! - J'ai perdu";
require 'includes/header.php';


function search ($query) 
{ 
    $query = trim($query); 
    PDO::quote();
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Veuillez saisir plus de caractéres.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Veuillez saisir moins de caractéres.</p>';
        } else { 
            $q = "SELECT *
                  FROM objets WHERE titre LIKE '%$query%' 
                  OR description LIKE '%$query%'
                  OR id_type LIKE '%$query%' 
                  OR id_lieu LIKE '%$query%' 
                  OR id_pays LIKE '%$query%' 
                  OR id_ville LIKE '%$query%'";

            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) { 
                $row = mysql_fetch_assoc($result); 
                $num = mysql_num_rows($result);

                $text = '<p>Votre recherche <b>'.$query.'</b> a donné ce résultat: '.$num.'</p>';

                do {
                    // On fait la recherche pour avoir les liens des objets
                    $q1 = "SELECT titre FROM objets WHERE id_objet = '$row[page_id]'";
                    $result1 = mysql_query($q1);

                    if (mysql_affected_rows() > 0) {
                        $row1 = mysql_fetch_assoc($result1);
                    }

                    $text .= '<p><a> href="'.$row1['titre'].'/'.$row['id_type'].'</a></p>
                    <p>'.$row['description'].'</p>';

                } while ($row = mysql_fetch_assoc($result)); 
            } else {
                $text = '<p>Votre recherche n\'a donné aucun résultat.</p>';
            }
        } 
    } else {
        $text = '<p>Aucun mot clés n\'a été saisi.</p>';
    }

    return $text; 
} 

if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>