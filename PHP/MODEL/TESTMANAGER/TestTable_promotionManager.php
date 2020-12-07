<?php

//Test Table_promotionManager

echo "recherche id = 1" . "<br>";
$obj =Table_promotionManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_promotion(["idCateg" => "([value 1])", "dateDebut" => "([value 2])", "dateFin" => "([value 3])", "taux" => "([value 4])"]);
var_dump(Table_promotionManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_promotionManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setidCateg("[(Value)]");
Table_promotionManager::update($obj);
$objUpdated = Table_promotionManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_promotionManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_promotionManager::findById(1);
Table_promotionManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_promotionManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>