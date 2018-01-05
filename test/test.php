<?php
require 'includes/header.php';
$safe = array_map('strip_tags', $_POST);
// retourne les balises <option> pour remplir un <select> de pays à partir des données d'une table

// ce code est destiné à être appelé via AJAX

// si problème rencontré, retournera plutôt une des chaînes suivantes :

// REQUETE : la requête a planté

// AUCUNEDONNEE : la requête n'a retourné aucune donnée

// NONDETERMINE : le programme a rencontré une erreur non déterminée

// Le branchement à la base de données est réputé fait.

 

$retour = "";

$requete = "SELECT id_pays, nom_fr_fr FROM pays ORDER BY nom_fr_fr";

$resultat = $dbh->query($requete)->fetchAll();     // exécute la requête



if ($resultat) {    // si la requête a fonctionné

        foreach($resultat as $enreg) {     // extrait chaque ligne une à une

            $retour .= '<option value="'
                       .$enreg['id_pays']
                       .'">'
                       .$enreg['nom_fr_fr']
                       .'</option>';

        }

}
    else {

        $retour = "AUCUNEDONNEE";

    }


 

// ne devrait jamais renter ici mais on conserve ce test au cas où

if ("" == $retour) {

    $retour = "NONDETERMINE";

}

 

echo $retour; // il faut faire un echo de code html puisque l'appel AJAX a été fait avec dataType: "html"




// retourne les balises <option> pour remplir un <select> de provinces selon le pays sélectionné

// ce code est destiné à être appelé via AJAX

// si problème rencontré, retournera plutôt une des chaînes suivantes :

// PARAMETRE : les données nécessaires n'ont pas été reçues en paramètre ou les paramètres n'étaient pas tous valides

// REQUETE : la requête a planté

// AUCUNEDONNEE : la requête n'a retourné aucune donnée

// NONDETERMINE : le programme a rencontré une erreur non déterminée

// Le branchement à la base de données est réputé fait.

 

$retour = "";

 

// retrouver le pays sélectionné, qui a été envoyé par AJAX

$pays = $_POST['pays'];

 

// valider les données côté serveur

$donneesValides = true;

if ('' == $pays) {

    $donneesValides = false;

}

else {

    // recherche si l'identifiant du pays existe dans la BD

    $requete = "SELECT nom_fr_fr FROM pays WHERE id_pays = 75";

    $stmt = $mysqli->prepare($requete);

 

    if ($stmt) {

 

        $stmt->bind_param("i", $pays);

        $stmt->execute();

        // Sans cette ligne, il ne sera pas possible de connaître le nombre de lignes retournées par un SELECT.

        $stmt->store_result();

 

        if ($stmt->num_rows == 0) {

            $donneesValides = false;

        }

 

        $stmt->close();

    }

    else {

        $retour = "REQUETE";

    }

}

 

if ($donneesValides && '' == $retour) {

 

    $requete = "SELECT code_departement, nom_departement FROM villes_france_free WHERE id_pays = ? ORDER BY nom_departement";

    $stmt = $dbh->prepare($requete)->fetchAll();

 

    if ($stmt) {

 

        $stmt->bind_param("i", $pays);

 

        $stmt->execute();

        // Sans cette ligne, il ne sera pas possible de connaître le nombre de lignes retournées par un SELECT.

        $stmt->store_result();

 

        if ($stmt->num_rows > 0) {

 

            $stmt->bind_result($province_id, $province_nom);

 

            while ($stmt->fetch()) {

                $retour .= "<option value='$province_id'>$province_nom</option>";

            }

        }

        else {

            $retour = "AUCUNEDONNEE";

        }

    }

    else {

        $retour = "REQUETE";

    }

 

    // ne devrait jamais renter ici mais on la laisse là au cas où

    if ("" == $retour) {

        $retour = "NONDETERMINE";

    }

}

else {

    $retour = "PARAMETRE";

}

 

echo $retour;


?>


<form method="post">

    <label for="pays">Pays :</label><select name="pays" id="pays" required></select>

    <label for="departement">Departement :</label><select name="departement" id="departement" required></select>

    <input type="submit" value="Envoyer" />

</form>

 

<script>

    $(function () {

        // dès le chargement de la page, on remplit la liste des pays

        remplirPays();

 

        // lorsque le pays sera changé dans la liste, on charge la liste des provinces ou états correspondants

        $("#pays").change(function (event) {

            remplirDepartement();

        });

    });

 

    function remplirPays() {

    var jqxhr = $.ajax({

            type: 'get', // on n'a pas de paramètres à envoyer alors GET est sécuritaire

            url: 'generer-options-pays.php',

            dataType: "html", // le fichier php fait un echo de code HTML

            contentType: "application/x-www-form-urlencoded; charset=UTF-8",

            data: ""

        })

        .done(function (response, textStatus, jqXHR) {

            // Appel réussi : on affiche le code HTML généré par le code serveur

            if ("REQUETE" == response) {

                $("#pays").html("<option value=''>Un problème technique nous empêche de retrouver les pays (code R).</option>");

            }

            else if ("AUCUNEDONNEE" == response) {

                $("#pays").html("<option value=''>Il n'y a actuellement aucun pays dans le système.</option>");

            }

            else if ("NONDETERMINE" == response) {

                $("#pays").html("<option value=''>Un problème technique nous empêche de retrouver les pays (code I).</option>");

            }

            else if (response.indexOf('<option') != 0) {

                // la chaîne ne débute pas par <option donc c'est probablement un message d'erreur PHP retourné par AJAX

                $("#pays").html("<option value=''>Un problème technique nous empêche de retrouver les pays (code E).</option>");

            }

            else {

                $("#pays").html("<option value=''>Veuillez choisir...</option>" + response);

            }

        })

        .fail(function (jqXHR, textStatus, errorThrown) {

            // Réagit si le code serveur n'a pas pu être appelé par AJAX, s'il a planté ou s'il n'a pas retourné le bon type de données

            $("#pays").html("<option value=''>Un problème technique nous empêche de retrouver les pays (code A).</option>");

        });

    }

 

    function remplirDepartement() {

        var pays = $('#pays').val();

        var dataString = 'pays=' + pays;

 

        var jqxhr = $.ajax({

            type: 'post',

            url: 'generer-options-departement.php',

            dataType: "html", // le fichier php fait un echo de code HTML

            contentType: "application/x-www-form-urlencoded; charset=UTF-8",

            data: dataString

        })

        .done(function (response, textStatus, jqXHR) {

            // Appel réussi : on affiche le code HTML généré par le code serveur

            if ("PARAMETRE" == response) {

                $("#departement").html("<option value=''>Le pays sélectionné n'est pas valide.</option>");

            }

            else if ("REQUETE" == response) {

                $("#departement").html("<option value=''>Un problème technique nous empêche de retrouver les departements (code R).</option>");

            }

            else if ("AUCUNEDONNEE" == response) {

                $("#departement").html("<option value=''>Il n'y a actuellement aucune province dans le système.</option>");

            }

            else if ("NONDETERMINE" == response) {

                $("#departement").html("<option value=''>Un problème technique nous empêche de retrouver les provinces (code I).</option>");

            }

            else if (response.indexOf('<option') != 0) {

                // la chaîne ne débute pas par <option donc c'est probablement un message d'erreur PHP retourné par AJAX

                $("#departement").html("<option value=''>Un problème technique nous empêche de retrouver les provinces (code E).</option>");

            }

            else {

                $("#departement").html("<option value=''>Veuillez choisir...</option>" + response);

            }

        })

        .fail(function (jqXHR, textStatus, errorThrown) {

            // Réagit si le code serveur n'a pas pu être appelé par AJAX, s'il a planté ou s'il n'a pas retourné le bon type de données

            $("#departement").html("<option value=''>Un problème technique nous empêche de retrouver les departements (code A).</option>");

        });

    }

 

</script>