<?php

//Test Table_categManager

echo "recherche id = 1" . "<br>";
$obj =Table_categManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_categ(["refCateg" => "([value 1])", "libCateg" => "([value 2])", "idUnivers" => "([value 3])"]);
var_dump(Table_categManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_categManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setrefCateg("[(Value)]");
Table_categManager::update($obj);
$objUpdated = Table_categManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_categManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_categManager::findById(1);
Table_categManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_categManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>