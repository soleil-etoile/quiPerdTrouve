<?php

/* boite à outils de bibliforce3 */

function verifPass($mdp)
{
    // longuer du mot de passe
    $longueur = strlen($mdp);

    // variables pour compter les maj et les nbr
    $nbMaj = $nbNum = 0;
    
    /* une chaine de caractères est un tableau */
    for($i = 0; $i < $longueur; $i++)
    {
        $caractere = $mdp[$i];
        // le caractère est it numérique?
        if(is_numeric($caractere)){ $nbNum++; }
        // li caractère est il une majuscule
        else if(strtoupper($caractere) == $caractere){ $nbMaj++; }
    }

    // test coérence mdp (8 caractères dont 1 maj et 1 nbr)
    if($longueur >= 8 && $nbMaj >= 1 && $nbNum >=1)
    {
        return true;
    }
    else return false;
}

/* fonction qui retourne une date aaaa-mm-jj
a partir d'une date jj/mm/aaaa'
renvoie une chaine de caractéres */
function dateDB($dte)
{
    $tabDte = explode('/', $dte);
    // on return $tabDte[2].'-'.$tabDte[1].'-'.$tabDte[0];
    return implode('-', array_reverse($tabDte));
}

/* fonction qui retourne une date jj/mm/aaaa 
à partir d'une date aaaa-mm-jj
en utilisant des substr() 
renvoie une chaine de caractéres */
function dateFR($dte)
{
    $aa = substr($dte, 0, 4);
    $mm = substr($dte, 5, 2);
    $jj = substr($dte, 8, 2);
    return $jj.'/'.$mm.'/'.$aa;
}


?>
