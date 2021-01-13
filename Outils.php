<?php
function ChargerClasse($classe)
{
    if (file_exists("PHP/CONTROLLER/" . $classe . ".Class.php")) {
        require "PHP/CONTROLLER/" . $classe . ".Class.php";
    }
    if (file_exists("PHP/MODEL/" . $classe . ".Class.php")) {
        require "PHP/MODEL/" . $classe . ".Class.php";
    }
}
spl_autoload_register("ChargerClasse");

function uri()
{
    $uri = $_SERVER['REQUEST_URI'];
    if (substr($uri, strlen($uri) - 1) == "/") // se termine par /
    {
        $uri .= "index.php?";
    } else if (in_array("?", str_split($uri))) // si l'uri contient deja un ?
    {
        $uri .= "&";
    } else {
        $uri .= "?";
    }
    return $uri;
}

function crypte($mot)
{
    return md5(md5($mot));
}

function texte($codeTexte)
{
    global $lang; //on appel la variable globale
    return TexteManager::findByCodes($lang, $codeTexte);
}

function afficherPage($page)
{
    $chemin = $page[0];
    $nom = $page[1];
    $titre = $page[2];
    if ($page[3]) {
        include $chemin . $nom . '.php';
    } else {
        include 'PHP/VIEW/Head.php';
        include 'PHP/VIEW/Header.php';
        include 'PHP/VIEW/Nav.php';
        include $chemin . $nom . '.php';
        include 'PHP/VIEW/Footer.php';
    }

}

// function optionComboBox($code, $nom)
// {
//     $ref=["Client"=>["id"=> "idClient","libelle"=>"NomClient"]];
//     $select = '<select id="id' . $nom . '" name="id' . $nom . '" >';
//     if ($nom = "Client") {
//         $liste = Table_clientManager::getList();
//     }

//     if ($code == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
//         $select .= '<option value="" SELECTED>Choisir une valeur</option>';
//     }
//     foreach ($liste as $elt) {
//         $methodId = "get" . $ref[$nom]["id"];
//         $methodLibelle = "get" . $ref[$nom]["libelle"];
//         if ($code == $elt->$methodId()) //appel de la methode stockée dans $method
//         { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
//             $select .= '<option value="' . $elt->$methodId() . '" SELECTED>' . $elt->$methodLibelle() . '</option>';
//         } else {
//             $select .= '<option value="' . $elt->$methodId() . '">' . $elt->$methodLibelle() . '</option>';
//         }
//     }
//     $select .= "</select>";
//     return $select;
// }

function optionComboBox($code, $nom, $class, $obj, $mode)
{
    $nom = ucfirst($nom);
    $rId = "getId" . $nom;
    $id = $obj->$rId();
    $listeInfos = $obj->getListeInfos();
    $rLib = "getLib" . $nom;
    $lib = $obj->$rLib();
    $ref = ["$nom" => ["id" => $id, "libelle" => $lib]];
    $select = '<select id="id' . $nom . '" name="id' . $nom . '"';
    if ($mode == "detail" || $mode == "delete") {
        $select .= " disabled ";
    }
    $select .= '>';
    $aux = "Table_" . $nom . "Manager";
    $liste = $aux::getList();

    if ($code == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
        $select .= '<option value="" SELECTED>Choisir une valeur</option>';
    }
    foreach ($liste as $elt) {
        // var_dump($code);
        // echo $code;
        // var_dump($elt->$rId());

        if ($code == $elt->$rId()) //appel de la methode stockée dans $method
        { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
            $select .= '<option value="' . $elt->$rId() . '" SELECTED>' . $elt->$rLib() . '</option>';
        } else {
            $select .= '<option value="' . $elt->$rId() . '">' . $elt->$rLib() . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}

/**
 * fonction qui construit un select en fonction des parametres
 * @valeur : valeur qui sera selected
 * @table : table de reference
 * @nomId : nom de l'id dans la table de reference
 * @$mode : mode ajout modif, edit ou supprime
 */
function optionSelect($valeur, $table, $nomId, $mode)
{
    // $nom = ucfirst($nom);
    // $rId = "getId".$nom;
    // $id = $obj->$rId();
    // $listeInfos = $obj->getListeInfos();
    // $rLib = "getLib".$nom;
    // $lib = $obj->$rLib();
    // $ref=["$nom"=>["id"=> $id ,"libelle"=>$lib]];
    $select = '<select id="' . $nomId . '" name="' . $nomId . '"';
    if ($mode == "detail" || $mode == "delete") {
        $select .= " disabled ";
    }
    $select .= '>';
    $liste = appelGetList("Table_" . $table);

    if ($valeur == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
        $select .= '<option value="" SELECTED>Choisir une valeur</option>';
    }
    foreach ($liste as $elt) {
        // var_dump($code);
        // echo $code;
        // var_dump($elt->$rId());

        if ($valeur == appelGet($elt, $nomId)) //appel de la methode stockée dans $method
        { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
            $select .= '<option value="' . appelGet($elt, $nomId) . '" SELECTED>' . appelGet($elt, "Libelle") . '</option>';
        } else {
            $select .= '<option value="' . appelGet($elt, $nomId) . '">' . appelGet($elt, "Libelle") . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}

/**
 * Fonction qui renvoi l'objet renvoyé par l'appel de la methode static FindById situé dans le manager de la classe
 * @nomTable : contient le nom de la table / classe
 * @id : contient l'id recherché
 */
function appelFindById($nomTable, $id)
{
    $methode = "Table_" . $nomTable . "Manager::findById";
    // $methode = $nomTable."Manager::findById";
    return call_user_func($methode, $id);
}

function appelGetList($nomTable)
{
    $methode = $nomTable . "Manager::getList";
    return call_user_func($methode);
}
/**
 * Fonction qui renvoi l'objet renvoyé par l'appel de la methode formé de Get et de la chaine de caractere
 * @obj : contient l'objet sur lequel porte l'appel
 * @chaine : contient la partie de la methode apres le get
 * ex: chaine="libelle" on appele la méthode $obj->getLibelle()
 */
function appelGet($obj, $chaine)
{
    $methode = 'get' . ucfirst($chaine);
    return call_user_func(array($obj, $methode));

}
