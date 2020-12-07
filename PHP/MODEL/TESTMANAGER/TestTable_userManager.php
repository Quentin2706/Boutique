<?php

//Test Table_userManager

echo "recherche id = 1" . "<br>";
$obj =Table_userManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_user(["pseudo" => "([value 1])", "password" => "([value 2])", "role" => "([value 3])"]);
var_dump(Table_userManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_userManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setpseudo("[(Value)]");
Table_userManager::update($obj);
$objUpdated = Table_userManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_userManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_userManager::findById(1);
Table_userManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_userManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>