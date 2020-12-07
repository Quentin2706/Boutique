<?php

//Test Table_universManager

echo "recherche id = 1" . "<br>";
$obj =Table_universManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_univers(["refUnivers" => "([value 1])", "libUnivers" => "([value 2])"]);
var_dump(Table_universManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_universManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setrefUnivers("[(Value)]");
Table_universManager::update($obj);
$objUpdated = Table_universManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_universManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_universManager::findById(1);
Table_universManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_universManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>