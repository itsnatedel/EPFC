<?php
    $tabPoids = array(76,62.5,45);
    var_dump($tabPoids);
    
    $tabPrenoms = array('Cyril', 'Malaïka', 'Abdel', 'Fritz');
    var_dump($tabPrenoms);

    $saisons = array(
        1 => 'hiver',
        'printemps',
        5 => 'été',
        'automne',
    );
    var_dump($saisons);

    $infosDate = array(
        'joursem' => 'lundi',
        'jour' => 4,
        'mois' => 'novembre',
        'année' => 2013,
    );
    var_dump($infosDate);

    $tabJours = array(
        'dimanche',
        'lundi',
        'mardi',
        'mercredi',
        'jeudi',
        'vendredi',
        'samedi',
    );
    var_dump($tabJours);

    $tabMois = array(
        'janvier',
        'février',
        'mars',
        'avril',
        'mai',
        'juin',
        'juillet',
        'août',
        'septembre',
        'octobre',
        'novembre',
        'décembre',
    );
    var_dump($tabMois);

    $dateComplet = array(
        'weekday' => 'Monday',
        'wday' => 1,
        'mday' => 4,
        'month' => 'November',
        'mon' => 11,
        'year' => 2013,
        'hours' => 15,
        'minutes' => 23,
        'seconds' => 58,
    );
    var_dump($dateComplet);

    $infosPays = array(
        'Belgique' => array(
            'capitale' => 'Bruxelles',
            'monnaie' => 'euro',
            'superficie' => 30528,
            'langues' => array(
                'français',
                'néerlandais',
                'allemand',
            ),
        ),
        'France' => array(
            'capitale' => 'Paris',
            'monnaie' => 'euro',
            'superficie' => 675417,
            'langues' => 'français',
        ),
        'Japon' => array(
            'capitale' => 'Tokyo',
            'monnaie' => 'yen',
            'superficie' => 377915,
            'langues' => 'japonais',
        ),
        'Suisse' => array(
            'capitale' => 'Berne',
            'monnaie' => 'franc suisse',
            'superficie' => 41285,
            'langues' => array(
                'allemand',
                'français',
                'italien',
                'romanche',
            ),
        ),
    );
    var_dump($infosPays);

    echo "2.Affichez chaque poids du tableau \$tabPoids sur un paragraphe différent.";
    foreach ($tabPoids as $value) {
        echo "<p> $value </p>";
    }

    echo "3. Affichez les prénoms du tableau \$tabPrenoms sous forme de liste non ordonnée (ul).";
    echo "<ul>";
    foreach ($tabPrenoms as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";

    echo "4. Affichez les prénoms du tableau \$tabPrenoms sous forme de liste mais en ordre inverse.";
    echo "<ul>";
    foreach (array_reverse($tabPrenoms) as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";

    echo "5. Affichez les poids  supérieur à 50. (\$tabPoids)";
    foreach ($tabPoids as $value) {
        if ($value > 50) {
            echo "<p>$value</p>";
        }
    }

    echo "6. Affichez un prénom sur deux sous forme de tableau à une colonne. (\$tabPrenoms)";
    echo "<table border=1>";
        for ($i = 0; $i < count($tabPrenoms); $i+=2) {
            echo "<tr> \n";
            echo "<td>$tabPrenoms[$i]</td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "7. Affichez chaque saison du tableau \$saisons séparés par une virgule et un espace </br>";
    //On ajoute virgule+espace à tous les éléments SAUF le dernier
    $last = end($saisons); //Récupère le dernier élément de l'array $saisons
    /* Les indexes de l'array $saisons sont : [1], [2], [5], [6]
    * => Une simple boucle for() créerait une erreur fatale vu que les index [3] et [4] n'existent pas
    * => Dans ce cas, il faut utiliser cette syntaxe : for(reset($array); current($array); next($saisons)) 
    */
    for (reset($saisons); current($saisons); next($saisons)) { 
        if (current($saisons) != $last) { //Si la valeur actuelle n'est pas la dernière
            echo current($saisons) . ", "; //Ecrit la valeur actuelle suivie d'une virgule et d'un espace
        }
    }
    echo $last . "</br>"; //Ecrit la dernière valeur de $saisons, sans virgule ni espace

    echo "8. Affichez les données du tableau \$infosDate sous la forme: Nous sommes en 2013, le lundi 4 novembre.";
    echo "<p>Nous somme en " . $infosDate['année'] . ", le {$infosDate['joursem']} " . $infosDate['jour'] . " {$infosDate['mois']}</p>";

    echo "9. Sachant que vous disposez des tableaux \$tabJours et \$tabMois. Affichez les données du tableau \$dateComplet sous la forme:
        Nous sommes un lundi de novembre et il est 15:23.";
    echo "<p>Nous sommes un {$tabJours[1]} de {$tabMois[10]} et il est " . $dateComplet['hours'] . ":" . $dateComplet['minutes'] . ".</p>";

    echo "10. En utilisant le tableau \$infosPays, </br>
        a. Affichez uniquement toutes les capitales.";
        foreach ($infosPays as $pays => $tabData) {
            foreach ($tabData as $info => $value) {
                if ($info == 'captiale') {
                    echo "<p>$value</p>";
                }
            }
        }
        foreach ($infosPays as $pays => $tabData) {
            echo "<p>{$tabData['capitale']}</p>";
        }
        
        echo "b. Affichez en détails toutes les données de tous les pays (en indiquant le pays).";
        foreach ($infosPays as $pays => $tabData) {
            echo "<p><strong>$pays</strong></p>";
            foreach ($tabData as $info => $value) {
                if (!is_array($value)) { //Si la case n'est pas un array
                    echo "<p>$info: $value</p>";
                } else {
                    echo "<p>$info:</p>";
                    echo "<ul>";
                    foreach ($value as $langues) {
                        echo "<li>$langues</li>";
                    }
                    echo "</ul>";
                }
            }
        }

        echo "c. Affichez la superficie du pays dont la capitale est Paris.";
        foreach ($infosPays as $pays => $tabData) {
            if ($tabData['capitale'] == 'Paris') {
                echo "<p>$pays: " . $tabData['superficie'] . "</p>";
            }
        }

        echo "d. Affichez tous les pays dont la superficie est supérieure à celle de la Suisse.";
        $superficieSuisse = $infosPays['Suisse']['superficie'];
        foreach ($infosPays as $pays => $tabData) {
            if ($tabData['superficie'] > $superficieSuisse) {
                echo "<p>$pays</p>";
            }
        }

        echo "e. Affichez toutes les langues officielles de Belgique.";
        $dataLangues = $infosPays['Belgique']['langues'];
        foreach ($dataLangues as $value) {
            echo "<p>$value</p>";
        }

        echo "f. Affichez (en indiquant le pays) les langues officielles de tous les pays.";
        foreach ($infosPays as $pays => $tabData) {
            echo "<p><strong>$pays</strong></p>";
            foreach ($tabData as $info => $infoPays)
            if ($info == 'langues') {
                if (is_array($infoPays)) {
                    foreach ($infoPays as $langues) {
                        echo "<p>$langues</p>";
                    }
                } else {
                    echo "<p>$infoPays</p>";
                } 
            }
        }

        echo "g. Affichez la monnaie des deux derniers pays.";
        $listePays = array_keys($infosPays);
        $lastPays = end($listePays); //Récupère le dernier pays de $infosPays
        $penultimatePays = prev($listePays); //Récupère l'avant-dernier pays de $infosPays
        echo "<p>". $infosPays[$penultimatePays]['monnaie'] . " et " . $infosPays[$lastPays]['monnaie'] . "</p>";

    echo "11. En utilisant le tableau \$tabPrenoms, </br>
        a. Ajoutez à la fin les prénoms suivants: Mike, Tanaka, Ramón.";
        array_push($tabPrenoms,"Mike","Tanaka","Ramón");
        var_dump($tabPrenoms);
    
        echo "b. Ajoutez au début les prénoms suivants: César, Pénélope.";
        array_unshift($tabPrenoms,"César","Pénélope");
        var_dump($tabPrenoms);

        echo "c. Supprimez le dernier prénom.";
        array_pop($tabPrenoms);
        var_dump($tabPrenoms);

        echo "d. Supprimez le premier prénom.";
        array_shift($tabPrenoms);
        var_dump($tabPrenoms);

        echo "e. Insérez le prénom Julie en deuxième position.";
        $nameToInsert = ['Julie'];
        array_splice($tabPrenoms, 1, 0, $nameToInsert);
        var_dump($tabPrenoms);

        echo "f. Supprimez les prénoms du troisième au cinquième prénom.";
        array_splice($tabPrenoms,2,3);
        var_dump($tabPrenoms);

    echo "12. En utilisant le tableau \$tabPoids, </br>
        a. Augmentez tous les poids de 5kg avec une boucle for.";
        for ($i = 0; $i < count($tabPoids); $i++) {
            $tabPoids[$i] += 5;
        }
        var_dump($tabPoids);

        echo" b. Augmentez tous les poids de 5kg avec une boucle foreach.";
        foreach ($tabPoids as $value) {
            $value += 5;
        }
        var_dump($tabPoids);

    echo "13. En utilisant le tableau \$infosPays,
        a. Ajoutez l'anglais comme langue supplémentaire pour tous les pays.";
        foreach ($infosPays as $pays => &$tabData) {
            if (is_array($tabData['langues'])) {
                array_push($tabData['langues'],"anglais");
            } else {
                $tabData['langues'] = array($tabData['langues'], 'anglais');
            }
        }
        var_dump($infosPays);

        echo "b. Ajoutez comme information supplémentaire l'extension de domaine correspondante à chaque pays (be, fr, jp, ch).";
        $infosPays['Belgique']['extension'] = 'be';
        $infosPays['France']['extension'] = 'fr';
        $infosPays['Japon']['extension'] = 'jp';
        $infosPays['Suisse']['extension'] = 'ch';
        var_dump($infosPays);

    echo "14. En utilisant le tableau \$infosPays,
        a. Calculez et affichez la superficie moyenne de tous les pays.";
        $totalSuperficie = 0;
        foreach ($infosPays as $pays => &$tabData) {
            foreach ($tabData as $info => $value) {
                if ($info == 'superficie') {
                    $totalSuperficie += $value;
                }   
            }
        }
        $moyenne = $totalSuperficie / count($infosPays);
        echo "<p>Moyenne de la superficie de tous les pays: " . $moyenne . "</p>";

        echo "b. Calculez et affichez la superficie moyenne des pays de la zone euro.";
        $totalSuperficie = 0;
        $cptPaysEuro = 0;
        foreach ($infosPays as $pays => &$tabData) {
            if ($tabData["monnaie"] == "euro") {
                $totalSuperficie += $tabData["superficie"];
                $cptPaysEuro++;
            }
        }
        $moyenne = $totalSuperficie / $cptPaysEuro;
        echo "<p>Il y a $cptPaysEuro pays faisant partie de l'UE, la superficie moyenne de ces deux pays: $moyenne</p>";
        
        echo "c. Affichez quel pays a la plus grande superficie.";
        $maxSuperficie = [];
        foreach ($infosPays as $pays => &$tabData) {
            foreach ($tabData as $info => $value) {
                if ($info == "superficie") {
                    array_push($maxSuperficie, $value);
                }
            }
        }
        foreach ($infosPays as $pays => &$tabData) {
            if ($tabData["superficie"] === max($maxSuperficie)) {
                echo "<p>Le pays ayant la plus grande superficie: $pays</p>";
            }
        }
        
        echo "d. Affichez quel pays en dehors de la zone euro a le plus de langues.";
        $horsEU = [];
        $nbLangues = [];
        foreach ($infosPays as $pays => &$tabData) {
            if ($tabData["monnaie"] != "euro") {
                array_push($horsEU, $pays); 
            }
            
        }
        if (in_array($pays, $horsEU)) {
            array_push($nbLangues, count($tabData["langues"]));
        }
        
        if (count($tabData["langues"]) === max($nbLangues)) {
            echo "<p>Le pays hors de l'UE ayant le plus de langues: $pays</p>";
        }
        
        echo "e. Affichez la liste des pays qui ont l'anglais comme langue.";
        foreach ($infosPays as $pays => &$tabData) {
            if (in_array("anglais", $tabData["langues"])) {
                echo "<p>$pays</p>";
            }
        }
        
        echo "f. Affichez la liste des pays qui ont l'anglais OU le français comme langue.";
        foreach ($infosPays as $pays => &$tabData) {
            if (in_array("anglais", $tabData["langues"]) || in_array("français", $tabData["langues"])) {
                echo "<p>$pays</p>";
            }
        }
        
        echo "g. Affichez la liste des pays qui ont l'anglais mais PAS le français comme langue.";
        foreach ($infosPays as $pays => &$tabData) {
            if (in_array("anglais", $tabData["langues"]) && !in_array("français",$tabData["langues"])) {
                echo "<p>$pays</p>";
            }
        }

        echo "h. Affichez une donnée au hasard pour chaque pays (PAYS – INFO: VALEUR).";
        foreach ($infosPays as $pays => $tabData) {
            $pays = strtoupper($pays);
            echo "<p>$pays - ";
            $random_key = array_rand($tabData);
            echo strtoUpper($random_key) . ": </p>";

            if (is_array($tabData[$random_key])){
                $hasard = array_rand($tabData["$random_key"]);
                echo "<p> " . $tabData[$random_key][$hasard] . "</p>";
            } else {
                echo "<p>$tabData[$random_key]</p>";
            }
        }
        
        echo "i. Affichez les pays qui ont une superficie inférieure à la moyenne.";
        $totalSuperficie = 0;
        foreach ($infosPays as $pays => &$tabData) {
            foreach ($tabData as $info => $value) {
                if ($info == 'superficie') {
                    $totalSuperficie += $value;
                }   
            }
        }
        $moyenne = $totalSuperficie / count($infosPays);
        foreach ($infosPays as $pays => &$tabData) {
            foreach ($tabData as $infos => $value) {
                if ($infos == 'superficie') {
                    if ($value < $moyenne) {
                        echo "<p>$pays</p>";
                    }
                }   
            }
        }
?>
