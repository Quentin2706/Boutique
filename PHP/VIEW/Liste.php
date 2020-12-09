<?php
// on recup la surcharge URL
$table = $_GET['table']; 
$objets = appelGetList("Table_".$table);

if (empty($objets)){
    echo 'La table est vide';
} else {
echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligne">';
    // le foreach affiche les noms des colonnes du tableau 
        foreach ($objets[0]->getListeLabel() as $unLabel)
        {
            echo'<div class="enTete">'.$unLabel.'</div>';
        }
        echo'<div class="enTete"></div>
    </div>';

    // on recupere les attributs de la classe
        $infos=$objets[0]->getListeAttributs();

    // On parcourt tout les objets pour afficher les differentes informations
foreach ($objets as $unObjet) {
    echo '<div class="ligne">';
    // Affichage des information une par une de l'objet
    for ($i = 2; $i<count($infos); $i++)
    {
        echo'<div class="contenu">'.appelGet($unObjet,$infos[$i]).'</div>';
    }
    echo '<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><img src="./IMG/modifie.png" alt="Modifier Univers"></button>
            <button><img src="./IMG/supprimer.png" alt="Supprimer Univers"></button>
        </div>
    </div>
</div>';

}

echo '</div>
</div>';
}
