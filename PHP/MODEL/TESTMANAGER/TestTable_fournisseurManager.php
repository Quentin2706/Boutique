<?php

//Test Table_fournisseurManager

// echo "recherche id = 1" . "<br>";
// $obj =Table_fournisseurManager::findByReference("SS");
// var_dump($obj);
// echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_fournisseur(["refFournisseur" => "3D", "libFournisseur" => "([value 2])", "adresseFournisseur" => "([value 3])", "telephoneFournisseur" => "([value 4])"]);
// var_dump(Table_fournisseurManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_fournisseurManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

// echo "on met à jour l'id 1" . "<br>";
// $obj->setrefFournisseur("[]");
// Table_fournisseurManager::update($obj);
// $objUpdated = Table_fournisseurManager::findById(92);
// echo "Liste des objets" . "<br>";
// $array = Table_fournisseurManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_fournisseurManager::findById(92);
// Table_fournisseurManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_fournisseurManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

?>