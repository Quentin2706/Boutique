<?php

// on recup la surcharge URL
$table = $_GET['table'];
$classe="Table_".ucfirst($table);
$mode = $_GET['mode'];
if ($mode != "ajout") {
    $id = $_GET['id'];
    // En fonction de la surchage on fait l'action appropriée
    $objet = appelFindById($table, $id);
}
// Pour l'ajout il faut quand même les listes d'info lié aux objets donc on récupère un objet de la table pour avoir les infos
else if ($table=="modepaiement"){ //gestion de l'ajout modePaiement
    $objet = appelFindById($table, "CB");
}else{
    $objet = appelFindById($table, 1); // gestion de l'ajout
}
$labels = $classe::getListeLabel();
$infos = $classe::getListeAttributs();
$listeClass = $classe::getListeClass();
$input = $classe::getListeTypeInput();
echo '<div class="conteneur">
<div class="blocform">
    <form action="index.php?page=Action&table='.$table.'&mode=' . $mode . '" method="POST">
        <div class="colonne">';

// On ajoute l'id en caché si on est pas en ajout
if ($mode != "ajout") {
    echo '<input name="' . $infos[1] . '" type="hidden" id="' . appelGet($objet,$infos[1]) . '" value="' . appelGet($objet,$infos[1]) . '"/>';
}


// On affiche tout les champs à renseigner 
for ($i = 2; $i < count($labels); $i++) { //on commmence à 2 car l'id est déja traité avant (index 1 des tableaux)
    echo '<div>';
    echo '<label for="' . $infos[$i] . '">' . $labels[$i] . '</label>';

    // Si le label est un select alors on utilise la fonction comboBox
    if ($input[$i] == "select") {
        if ($mode == "ajout") {
            // echo optionComboBox(null,$listeClass[$i],"",$objet,$mode);
            echo optionSelect(null, $listeClass[$i], $infos[$i], $mode);
        } else {
            echo optionSelect(appelGet($objet, $infos[$i]), $listeClass[$i], $infos[$i], $mode);
        }
    }
    // Input simple
    else {
        echo '<input name="' . $infos[$i] . '" type="' . $input[$i] . '" required';
        if ($mode != "ajout") {
            if($infos[$i] != "password")
            {
            echo ' value= "' . appelGet($objet, $infos[$i]) . '"';
            } else {
                echo ' value= ""';
            }
        }
        // Insertions des données si on n'est pas dans ajout
        if ($mode == "detail" || $mode == "delete") {
            echo ' disabled';
        }
        // Désactivation des champs pour le mode détail et supprimer
        echo '/>';
    }
    echo '</div>';
    echo '<div class="espace"></div>';
}

echo '<div class="espace"></div>
<div class="centrer ligne">';
    switch ($mode)
    {
        case "ajout": echo '<input  class="bouton centrer" type="submit" value="Ajouter">';break;
        case "modif": echo '<input  class="bouton centrer" type="submit" value="Modifier">';break;
        case "delete": echo '<input  class="bouton centrer" type="submit" value="Supprimer">';break;
    }
    echo '<div class="foisDemi"></div><a href="index.php?page=Liste&table='.$table.'"><input  class="bouton centrer" value="Annuler"></a>';
echo     '
</div>

</div>
</form>
</div>

</div>';
