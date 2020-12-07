<?php

/**
 * optionComboBox : crée une combobox et preselectionne le code si donné
 *
 * @param  mixed $code           code de présence existante (ou non)
 * @param mixed $nom            nom de la combo
 * @return void
 */

function optionComboBox($code, $nom)
{
    $ref=["Client"=>["id"=> "idClient","libelle"=>"NomClient"]];
    $select = '<select id="id' . $nom . '" name="id' . $nom . '" >';
    if ($nom = "Client") {
        $liste = ClientManager::getList();
    }

    if ($code == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
        $select .= '<option value="" SELECTED>Choisir une valeur</option>';
    }
    foreach ($liste as $elt) {
        $methodId = "get" . $ref[$nom]["id"];
        $methodLibelle = "get" . $ref[$nom]["libelle"];
        if ($code == $elt->$methodId()) //appel de la methode stockée dans $method
        { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné 
            $select .= '<option value="' . $elt->$methodId() . '" SELECTED>' . $elt->$methodLibelle() . '</option>';
        } else {
            $select .= '<option value="' . $elt->$methodId() . '">' . $elt->$methodLibelle() . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}
