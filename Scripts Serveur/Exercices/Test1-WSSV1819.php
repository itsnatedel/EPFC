<?php

$liste = array(
    "cadeaux" => array(
        array(
            "nom" => "DVD Interstellar",
            "acheté" => true,
            "prix" => 8,
        ),

        array(
            "nom" => "Paire de chaussettes",
            "acheté" => false,
            "prix" => 3.50,
            "amis" => array(
                17,
                42,
                29,
            ),
        ),

        array(
            "nom" => "Grille-pain",
            "acheté" => false,
            "prix" => 20,
            "amis" => array(
                29,
                17,
            ),
        ),
    ),
    "amis" => array(
        17 => array(
            "prénom" => "Maggie",
            "dateNaissance" => mktime(0, 0, 0, 9, 16, 2003), //16/09/2003
        ),
        29 => array(
            "prénom" => "Philippe",
            "dateNaissance" => mktime(0, 0, 0, 9, 21, 2001), //21/09/2001
        ),
        42 => array(
            "prénom" => "Klajd",
            "dateNaissance" => mktime(0, 0, 0, 1, 15, 1999), //15/01/1999
        ),
    ),
);

var_dump($liste);


//2.a Dans combien de jours aura lieu le prochain anniversaire de mes amis (par rapport à aujourd’hui)
$today = time(); //Génère la date et heure de maintenant

foreach ($liste['amis'] as $ami) {
    $dateNaissance = $ami['dateNaissance'];
    $dateAnniversaire = mktime(0, 0, 0, date('n', $dateNaissance), date('j', $dateNaissance), date('Y', $today));

    if ($dateAnniversaire < $today) {
        //Ajouter un an 
        $dateAnniversaire = mktime(0, 0, 0, date('n', $dateNaissance), date('j', $dateNaissance), date('Y', $today) + 1);
    }
    $nbJours = ceil(($dateAnniversaire - $today) / (60 * 60 * 24));
    echo "<p>Anniversaire de " . $ami['prénom'] . " dans $nbJours jours.</p>";
}

//2.b Augmentez de 2% le prix des cadeaux qui n’ont pas encore été achetés.
foreach ($liste['cadeaux']  as $cadeau) {
    if ($cadeau['acheté'] === false) {
        $cadeau['prix'] += $cadeau['prix'] * 0.02;
        echo "<p>" . $cadeau['prix'] . "</p>";
    }
}

//2.c Afficher en maj le prénom des amis qui ont leur anniversaires en septembre

foreach ($liste['amis'] as $ami) {
    $dateNaissance = $ami['dateNaissance'];

    if (date('F', $dateNaissance) === "September") {
        echo "<p>" . strtoupper($ami["prénom"]) . "</p>";
    }
}

/**
 * 3. Sur base du tableau $liste, écrivez la fonction computeValue qui renvoie le montant total des cadeaux destinés à un ami spécifié.
 * Sans mention de l’ami, la fonction renvoie le total de tous les cadeaux pour chaque ami auquel ils sont destinés.
 * A. La fonction renvoie false si le premier paramètre n’est pas un tableau composé des clés « cadeaux » et « amis ». 
 * B. La fonction renvoie false si le second paramètre n’est pas un nombre entier.
 */

function computeValue($table, $friend = null)
{
    $montant = 0; //Initialisation du montant

    //Retourne false si le premier @param n'est pas un tableau
    if ((!isset($table["cadeaux"]) && !isset($table["amis"])) || !is_array($table)) {
        return false;
    }

    //Retourne false si le second @param est une chaîne vide
    if ($friend === '') {
        return false;
    }

    if ($friend === null) {
        //Renvoie le montant total de tous les cadeaux non-achetés
        foreach ($table["cadeaux"] as $gift) {
            if ($gift["acheté"] === false) {
                $montant += ($gift["prix"] * count($gift["amis"]));
            }
        }
        return $montant;
    } else {
        //renvoie le montant total des cadeaux destinés à un ami spécifié.
        foreach ($table["cadeaux"] as $gift) {
            if ($gift["acheté"] === false) {
                if (in_array($friend, $gift["amis"])) {
                    $montant += $gift["prix"];
                }
            }
        }
        return $montant;
    }

    //Retourne false si le second @param n'est pas un entier
    if (!is_int($friend)) {
        return false;
    }

    //Renvoie un montant valant 0 si l'ami n'est pas dans le tableau
    if (!in_array($friend, $table)) {
        return $montant;
    }
}

//TESTS UNITAIRES
var_dump(computeValue($liste, 17)); // 23.5
var_dump(computeValue($liste, 31)); // 0
var_dump(computeValue($liste));     // 50.5
var_dump(computeValue($liste, '')); // false
var_dump(computeValue([], '17'));   // false
var_dump(computeValue(777, 17));    // false
