<?php
$carnet = array(
    "Bruxelles" => array(
        array(
            "prénom" => "Mike",
            "dateNaiss" => mktime(0, 0, 0, 4, 21, 1951),
            "célibataire" => false,
            "genre" => "h",
            "solde" => 3500,
        ),
        array(
            "prénom" => "Alpha",
            "dateNaiss" => mktime(0, 0, 0, 1, 1, 1951),
            "célibataire" => false,
            "genre" => "h",
            "solde" => 0,
        ),
        array(
            "prénom" => "Malya",
            "dateNaiss" => mktime(0, 0, 0, 1, 30, 2020),
            "célibataire" => true,
            "genre" => "f",
            "solde" => 700,
        ),
    ),
    "Séoul" => array(
        array(
            "prénom" => "Netravati",
            "dateNaiss" => mktime(0, 0, 0, 2, 8, 1979),
            "célibataire" => true,
            "genre" => "f",
            "solde" => 4200,
        ),
        array(
            "prénom" => "Kim",
            "dateNaiss" => mktime(0, 0, 0, 12, 31, 2010),
            "célibataire" => true,
            "genre" => "h",
            "solde" => 50,
        ),
    )
);
var_dump($carnet);

// 2. Sur base du tableau $carnet
// a) Mois en lettre du dernier Bruxellois du carnet
$lastBx = end($carnet['Bruxelles']);
setlocale(LC_TIME, "fr");
echo "a) Dernier Bruxellois né un : " . ucfirst(strftime("%B", $lastBx['dateNaiss'])) . "<br>";

// b) Premier habitant de Séoul, célibataire ou non?
$firstSeoul = reset($carnet['Séoul']);
echo "b) Premier havitant de Séoul, célibataire? \n";
echo var_export(($firstSeoul['célibataire'])) . "<br>";

// c) Solde total des femmes
$femmes = array();
foreach ($carnet as $habitants) {
    foreach ($habitants as $infoHabitant) {
        if ($infoHabitant['genre'] == "f") {
            array_unshift($femmes, $infoHabitant['solde']);
        }
    }
}
echo "c) Solde total des femmes vaut : " . array_sum($femmes) . "<br>";

// d) Retirer 50€ de solde à un Bruxellois au hasard
$random = rand(0, sizeof($carnet['Bruxelles']) - 1);
echo "d) Le solde de " . $carnet['Bruxelles'][$random]['prénom'] . " valait " . $carnet['Bruxelles'][$random]['solde'] . " € et vaut maintenant : " . ($carnet['Bruxelles'][$random]['solde'] - 50) . " €. <br>";

// e) Afficher le prénom et l'année de naissance de toutes les personnes dont le prénom contient au moins un i
echo "e) ";
foreach ($carnet as $habitant) {
    foreach ($habitant as $infoHabitant) {
        if (strpos($infoHabitant['prénom'], "i") !== false) {
            echo $infoHabitant['prénom'] . " né(e) en " . date("Y", $infoHabitant['dateNaiss']) . "<br>";
        }
    }
}

/** Sur base du tableau $carnet
 * Écrire la fonction getGeneration() 
 * -> Renvoie un array des prénoms de toutes les personnes nées dans la même année
 * -> L'année pourra être précisée, sinon la fonction renvoie les personnes nées il y a 10 ans, par défaut
 * -> Renvoie false si l'année n'est pas un entier positif
 * -> Renvoie false si le paramètre $carnet n'est pas un tableau ou est vide
 */
function getGeneration($arr, $year = 10)
{
    $personSameYear = [];

    // Renvoie false si l'année n'est pas un entier positif
    if (!is_int($year) || ($year < 0)) { 
        return false;
    }
    // Renvoie false si le paramètre $carnet n'est pas un tableau ou est vide
    if (!is_array($arr) || empty($arr)) {
        return false;
    }

    if ($year !== 10) { // Si l'année est spécifiée
        foreach ($arr as $habitants) {
            foreach ($habitants as $infoHabitant) {
                if (date("Y", $infoHabitant['dateNaiss']) == $year) {
                    array_push($personSameYear, $infoHabitant['prénom']);
                }
            }
        }
    } else {
        foreach ($arr as $habitants) {
            foreach ($habitants as $infoHabitant) {
                if (date("Y", $infoHabitant['dateNaiss']) == date('Y', strtotime("-10 years"))) { // Si l'année de naissance == l'année d'il y a 10 ans
                    array_push($personSameYear, $infoHabitant['prénom']);
                }
            }
        }
    }

    return $personSameYear;
};

echo "3. Nés en 1951: ";
echo var_export(getGeneration($carnet, 1951));

//Test Unitaires
var_dump(getGeneration($carnet, 1951) === ['Mike', 'Alpha']); // true
var_dump(getGeneration($carnet, 2006) === []); // true 
var_dump(getGeneration($carnet) === ['Kim']); // true
var_dump(getGeneration($carnet, "z") === false); // true
var_dump(getGeneration($carnet, -100) === false); // true
var_dump(getGeneration('aaa', 1979) === false); // true
var_dump(getGeneration([], 2020) === false); // true
var_dump(getGeneration($carnet, 100.6)); // false
var_dump(getGeneration(50, 100)); // false
?>
