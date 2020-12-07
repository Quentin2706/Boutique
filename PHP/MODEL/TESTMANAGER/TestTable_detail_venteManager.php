<?php

//Test Table_detail_venteManager

echo "recherche id = 1" . "<br>";
$obj =Table_detail_venteManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_detail_vente(["idVente" => "([value 1])", "quantite" => "([value 2])", "idArticle" => "([value 3])", "prixUnitaire" => "([value 4])", "detailDivers" => "([value 5])"]);
var_dump(Table_detail_venteManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_detail_venteManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setidVente("[(Value)]");
Table_detail_venteManager::update($obj);
$objUpdated = Table_detail_venteManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_detail_venteManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_detail_venteManager::findById(1);
Table_detail_venteManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_detail_venteManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>