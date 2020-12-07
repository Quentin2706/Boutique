<?php

//Test Table_couleurManager

echo "recherche id = 1" . "<br>";
$obj =Table_couleurManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_couleur(["libCouleur" => "([value 1])", "refCouleur" => "([value 2])"]);
var_dump(Table_couleurManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_couleurManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setlibCouleur("[(Value)]");
Table_couleurManager::update($obj);
$objUpdated = Table_couleurManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_couleurManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_couleurManager::findById(1);
Table_couleurManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_couleurManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>