<?php

//Test Table_paiementManager

echo "recherche id = 1" . "<br>";
$obj =Table_paiementManager::findById(1);
var_dump($obj);
echo $obj->toString();

echo "ajout de l'objet". "<br>";
$newObj = new Table_paiement(["idVente" => "([value 1])", "idmodePaiement" => "([value 2])", "montant" => "([value 3])", "idClient" => "([value 4])", "banque" => "([value 5])"]);
var_dump(Table_paiementManager::add($newObj));

echo "Liste des objets" . "<br>";
$array = Table_paiementManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on met à jour l'id 1" . "<br>";
$obj->setidVente("[(Value)]");
Table_paiementManager::update($obj);
$objUpdated = Table_paiementManager::findById(1);
echo "Liste des objets" . "<br>";
$array = Table_paiementManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

echo "on supprime un objet". "<br>";
$obj = Table_paiementManager::findById(1);
Table_paiementManager::delete($obj);
echo "Liste des objets" . "<br>";
$array = Table_paiementManager::getList();
foreach ($array as $unObj)
{
	echo $unObj->toString() . "<br><br>";
}

?>