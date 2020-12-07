<?php

//Test Table_modepaiementManager

echo "recherche id = 1" . "<br>";
$obj =Table_modepaiementManager::findById("AT");
var_dump($obj);
echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_modepaiement(["idModePaiement"=>"GH","libModePaiement" => "fafa"]);
// var_dump(Table_modepaiementManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_modepaiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setlibModePaiement("ft");
// Table_modepaiementManager::update($obj);
// $objUpdated = Table_modepaiementManager::findById(1);
// echo "Liste des objets" . "<br>";
// $array = Table_modepaiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_modepaiementManager::findById("GH");
// Table_modepaiementManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_modepaiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

echo "recherche par code Don" . "<br>";
$obj =Table_modepaiementManager::findByCodeMode("Don");
var_dump($obj);
echo $obj->toString();

?>