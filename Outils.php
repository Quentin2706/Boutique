<?php
function ChargerClasse($classe)
{
	if (file_exists("PHP/CONTROLLER/" . $classe . ".Class.php"))
	{
		require "PHP/CONTROLLER/" . $classe . ".Class.php";
	}
	if (file_exists("PHP/MODEL/" . $classe . ".Class.php"))
	{
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
	}
	else if (in_array("?", str_split($uri))) // si l'uri contient deja un ?
	{
		$uri .= "&";
	}
	else
	{
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
	$chemin=$page[0];
	$nom=$page[1];
	$titre=$page[2];

	include 'PHP/VIEW/Head.php';
	include 'PHP/VIEW/Header.php';
	include 'PHP/VIEW/Nav.php';
	include $chemin.$nom.'.php';
	include 'PHP/VIEW/Footer.php';
}

function optionComboBox($code, $nom)
{
    $ref=["Client"=>["id"=> "idClient","libelle"=>"NomClient"]];
    $select = '<select id="id' . $nom . '" name="id' . $nom . '" >';
    if ($nom = "Client") {
        $liste = Table_clientManager::getList();
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