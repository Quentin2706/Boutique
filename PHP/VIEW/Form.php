<?php

// on recup la surcharge URL
$table = $_GET['table'];
$id = $_GET['id'];
$mode = $_GET['mode'];
if ($mode != "ajout") {
    $id = $_GET['id'];
}
// En fonction de la surchage on fait l'action appropriée
$objet = appelFindById($table, $id);
echo '<div class="conteneur">
<div class="blocform">
    <form action="index.php?page=Actions.php&mode=' . $mode . '" method="POST">
        <div class="colonne">';

// On ajoute l'id en caché si on est pas en ajout
if ($mode != "ajout") {
    echo '<input name="' . $objet->getListeAttributs()[1] . '" type="hidden" id="' . $objet->getListeAttributs()[1] . '" value="' . $objet->getListeAttributs()[1] . '"/>';
}

$labels = $objet->getListeLabel();
$infos = $objet->getListeAttributs();
$listeClass = $objet->getListeClass();
$input = $objet->getListeTypeInput();
// On affiche tout les champs à renseigner
for ($i = 1; $i < count($labels); $i++) {
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
            echo ' value= "' . appelGet($objet, $infos[$i]) . '"';
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
<div class="centrer">
    <input  class="bouton centrer" type="submit" value="Ajouter">
</div>

</div>
</form>
</div>

</div>';
