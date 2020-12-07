<?php

//Test Table_paiementManager

echo "recherche id = 1" . "<br>";
$obj =Table_paiementManager::findById(2);
var_dump($obj);
echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_paiement(["idVente" => "2", "idmodePaiement" => "AT", "montant" => "15", "idClient" => "5", "banque" => "dazdaz"]);
// var_dump(Table_paiementManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_paiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setMontant(2);
// Table_paiementManager::update($obj);
// $objUpdated = Table_paiementManager::findById(1);
// echo "Liste des objets" . "<br>";
// $array = Table_paiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_paiementManager::findById(1);
// Table_paiementManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_paiementManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

echo "sommepaiement de idvente = 2" . "<br>";
$obj =Table_paiementManager::sommePaiement(2);
var_dump($obj);

echo "montant total de idvente = 2" . "<br>";
$obj =Table_paiementManager::montantTotal(2);
var_dump($obj);

echo "montant total remise idvente = 2" . "<br>";
$obj =Table_paiementManager::montantTotalRemise(2,10);
var_dump($obj);

echo "resteDu idvente = 2" . "<br>";
$obj =Table_paiementManager::resteDu(2);
var_dump($obj);

?>