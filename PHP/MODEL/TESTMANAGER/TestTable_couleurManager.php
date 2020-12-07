<?php

//Test Table_couleurManager

echo "recherche id = 1" . "<br>";
$obj =Table_couleurManager::findByReference(60);
var_dump($obj);
echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_couleur(["libCouleur" => "TEST", "refCouleur" => "64"]);
// var_dump(Table_couleurManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_couleurManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setlibCouleur("[(Value)]");
// Table_couleurManager::update($obj);
// $objUpdated = Table_couleurManager::findById(40);
// echo "Liste des objets" . "<br>";
// $array = Table_couleurManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_couleurManager::findById(40);
// Table_couleurManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_couleurManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

?>