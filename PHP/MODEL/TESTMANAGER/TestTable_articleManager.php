<?php

//Test Table_articleManager

echo "recherche id = 1" . "<br>";
$obj =Table_articleManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_article(["refArticle" => "([value 1])", "libArticle" => "([value 2])", "idUnivers" => "([value 3])", "idCateg" => "([value 4])", "idFournisseur" => "([value 5])", "idCouleur" => "([value 6])", "idTaille" => "([value 7])", "idIncrementale" => "([value 8])", "idLot" => "([value 9])", "quantiteStock" => "([value 10])", "prixAchat" => "([value 11])", "prixVente" => "([value 12])", "seuil" => "([value 13])"]);
var_dump(Table_articleManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_articleManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setrefArticle("[(Value)]");
Table_articleManager::update($obj);
$objUpdated = Table_articleManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_articleManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_articleManager::findById(1);
Table_articleManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_articleManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>