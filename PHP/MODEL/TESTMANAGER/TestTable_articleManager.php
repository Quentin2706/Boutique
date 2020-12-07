<?php

//Test Table_articleManager

// echo "recherche id = 1" . "<br>";
// $obj =Table_articleManager::findById(6199);
// var_dump($obj);
// echo $obj->toString();

// echo "ajout de l'objet". "<br>";
// $newObj = new Table_article(["refArticle" => "gezgzgzgzg", "libArticle" => "test", "idUnivers" => 1, "idCateg" => 1, "idFournisseur" => 1, "idCouleur" => 1, "idTaille" => 1, "idIncrementale" => "1", "idLot" => 1, "quantiteStock" => 1, "prixAchat" => 1, "prixVente" => 1, "seuil" => 1]);
// var_dump(Table_articleManager::add($newObj));

// echo "Liste des objets" . "<br>";
// $array = Table_articleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on met à jour l'id 1" . "<br>";
// $obj->setrefArticle("zgeg");
// Table_articleManager::update($obj);
// $objUpdated = Table_articleManager::findById(6199);
// echo "Liste des objets" . "<br>";
// $array = Table_articleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on supprime un objet". "<br>";
// $obj = Table_articleManager::findById(6199);
// Table_articleManager::delete($obj);
// echo "Liste des objets" . "<br>";
// $array = Table_articleManager::getList();
// foreach ($array as $unObj)
// {
// 	echo $unObj->toString() . "<br><br>";
// }

// echo "on recherche un objet avec plusieurs mots". "<br>";
// $tab = ["idCateg" => 1,"idFournisseur" => 54, "idCouleur" => 1];
// $liste = Table_articleManager::rechercheMulti($tab);
// var_dump($liste);


////////////////////////           REGARDER CE QU'IL NE FONCTIONNE PAS AVEC LE DATETIME              /////////////////////////////

// SELECT taux FROM table_promotion WHERE idCateg= 2 AND dateDebut < 2020-12-02 14:27:35 AND dateFin > 2020-12-16 14:27:35 ELLE NE FONCTIONNE PAS
// $obj = Table_articleManager::findById(2328);
// echo Table_articleManager::calculPrixPromotion($obj);


?>