<?php

//Test Table_lotManager

echo "recherche id = 1" . "<br>";
$obj =Table_lotManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_lot(["reflot" => "([value 1])"]);
var_dump(Table_lotManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_lotManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setreflot("[(Value)]");
Table_lotManager::update($obj);
$objUpdated = Table_lotManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_lotManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_lotManager::findById(1);
Table_lotManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_lotManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>