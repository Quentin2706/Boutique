<?php

//Test Table_venteManager

echo "recherche id = 1" . "<br>";
$obj =Table_venteManager::findById(2);
var_dump($obj);
echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_vente(["date_vente" => "2018-02-10", "idClient" => 3]);
// var_dump(Table_venteManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_venteManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setDate_vente("2000-10-10");
// Table_venteManager::update($obj);
// $objUpdated = Table_venteManager::findById(1);
// echo "Liste des objets" . "<br>";
// $array = Table_venteManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_venteManager::findById(1);
// Table_venteManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_venteManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

echo "Liste des objets par date" . "<br>";
$array = Table_venteManager::findListByDate("2018-02-10");
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "recherche date = 2018-02-10" . "<br>";
$obj =Table_venteManager::findByDate("2018-02-10");
var_dump($obj);
echo $obj->toString();

echo "recherche client" . "<br>";
$client=Table_clientManager::findById(3);
$obj =Table_venteManager::findListByClient($client);
var_dump($obj);


?>