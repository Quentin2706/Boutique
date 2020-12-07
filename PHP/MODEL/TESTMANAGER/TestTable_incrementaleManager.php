<?php

//Test Table_incrementaleManager

// echo "recherche id = 1" . "<br>";
$obj =Table_incrementaleManager::findById(100);
// var_dump($obj);
// echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_incrementale(["refIncrementale" => "te"]);
// var_dump(Table_incrementaleManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_incrementaleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setrefIncrementale("et");
// Table_incrementaleManager::update($obj);
// $objUpdated = Table_incrementaleManager::findById(100);
// echo "Liste des objets" . "<br>";
// $array = Table_incrementaleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_incrementaleManager::findById(100);
// Table_incrementaleManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_incrementaleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

?>