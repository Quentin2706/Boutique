<?php

//Test Table_clientManager

echo "recherche id = 1" . "<br>";
$obj =Table_clientManager::findById(1);
var_dump($obj);
echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_client(["nomClient" => "toto", "adresseMail" => "azfz", "adressePostale" => "fafa"]);
// var_dump(Table_clientManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_clientManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setnomClient("azf");
// Table_clientManager::update($obj);
// $objUpdated = Table_clientManager::findById(1);
// echo "Liste des objets" . "<br>";
// $array = Table_clientManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_clientManager::findById(29);
// Table_clientManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_clientManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

echo "recherche par nom " . "<br>";
$obj =Table_clientManager::findByNom("cars PERDIGEON");
var_dump($obj);
echo $obj->toString();

?>