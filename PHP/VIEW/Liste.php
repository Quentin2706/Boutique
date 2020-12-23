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
    $listeLabel = $objets[0]->getListeLabel();
        for($i=2;$i<count($listeLabel);$i++)
        {
            echo'<div class="enTete">'.$listeLabel[$i].'</div>';
        }
        echo'<div class="enTete"><div class="miniBouton centrer ligne">
        <button><a href="index.php?page=Form&table='.$table.'&mode=ajout"><img src="./IMG/plus mauve.png" alt="Ajouter"></a></button>
    </div></div>
    </div>';

    // on recupere les attributs de la classe
        $infos=$objets[0]->getListeAttributs();

    // On parcourt tout les objets pour afficher les differentes informations
foreach ($objets as $unObjet) {
    echo '<div class="ligne">';
    //on vérifie si on doit faire appel à l'objet lié pour afficher le libelle au lieu de la clé secondaire
    $listeTypeInput = $objets[0]->getListeTypeInput();
    $listeClasse = $objets[0]->getListeClass();
    $id = appelGet($unObjet,"id".$table);
    // Affichage des information une par une de l'objet
    for ($i = 2; $i<count($infos); $i++)
    {
        if ($listeTypeInput[$i]=="select")
        {
            $classe = $listeClasse[$i];
            $obj = appelFindById($classe,appelGet($unObjet,$infos[$i]));
            echo'<div class="contenu">'.$obj->getLibelle().'</div>';
        }
        else
        {
            echo'<div class="contenu">'.appelGet($unObjet,$infos[$i]).'</div>';
        }
    }
    echo '<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><a href="index.php?page=Form&table='.$table.'&mode=modif&id='.$id.'"><img src="./IMG/modifie.png" alt="Modifier Univers"></a></button>
            <button><a href="index.php?page=Form&table='.$table.'&mode=delete&id='.$id.'"><img src="./IMG/supprimer.png" alt="Supprimer Univers"></a></button>
        </div>
    </div>
</div>';

}

echo '</div>
</div>';
}