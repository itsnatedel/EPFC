<?php
    $liste = array (
        "cadeaux" => array (
            array (
                "nom" => "DVD Interstellar",
                "acheté" => true,
                "prix" => 8,
            ),
            
            array (
                "nom" => "Paire de chaussettes",
                "acheté" => false,
                "prix" => 3.50,
                "amis" => array (
                    17,
                    42,
                    29,
                ),
            ),
            
            array (
                "nom" => "Grille-pain",
                "acheté" => false,
                "prix" => 20,
                "amis" => array (
                    29,
                    17,
                ),
            ),
        ),
        "amis" => array (
            17 => array (
                "prénom" => "Maggie",
                "dateNaissance" => mktime(0,0,0,9,16,2003),
            ),
            29 => array (
                "prénom" => "Philippe",
                "dateNaissance" => mktime(0,0,0,9,21,2001),
            ),
            42 => array (
                "prénom" => "Klajd",
                "dateNaissance" => mktime(0,0,0,1,15,1999),
            ),
        ),
    );

var_dump($liste);


$today = time();

foreach ($liste['amis'] as $ami) {
    $dateNaissance = $ami['dateNaissance'];
    $dateAnniversaire = mktime(0,0,0, date('n', $dateNaissance), date('j',$dateNaissance), date('Y', $today)); //Année AJD

    if ($dateAnniversaire < $today) { 
        //Ajouter un an 
        $dateAnniversaire = mktime(0,0,0, date('n', $dateNaissance), date('j',$dateNaissance), date('Y', $today) + 1); //Année 1 an
    }
    $nbJours = ceil(($dateAnniversaire - $today) / (60*60*24));
    echo "<p>Anniversaire de " . $ami['prénom'] . " dans $nbJours jours.</p>";

}

//2.b
foreach($liste['cadeaux']  as $cadeau){
	if($cadeau['acheté'] === false){
		$cadeau['prix'] += $cadeau['prix']*0.02;
		echo "<p>".$cadeau['prix']."</p>";
	}
}

//2.c Afficher en maj le prénom des amis qui ont leur anniversaires en septembre
?>
