<?php

$article=Table_articleManager::findByReference($_POST["refPC"]);
$promotions=Table_promotionManager::getListByCateg($article->getIdCateg()); //On récupère les promotions de la categ
$dateAuj=new DateTime("now");
$dateAuj=$dateAuj->format("Y-m-d");
$prix=$article->getPrixVente();// Initialisation du prix de l'article si il n'y a pas de promotion
//Gestion des promotions
for($i=0;$i<count($promotions);$i++){
    //On récupére la date de la promotion au format aaaa-mm-dd
    $dateFin=substr($promotions[$i]->getDateFin(),0,10);
    $dateDebut=substr($promotions[$i]->getDateDebut(),0,10);
    if($dateAuj>$dateDebut && $dateAuj<$dateFin){ //On ne prend que la promotion actuelle de la categ
        $prix=round($article->getPrixVente()-$article->getPrixVente()*($promotions[$i]->getTaux()/100),2);
    }
}

$newArticle= ["refArticle" => $article->getRefArticle(), "libArticle" => $article->getLibArticle(), "idUnivers" => $article->getIdUnivers(), "idCateg" => $article->getIdCateg(), "idFournisseur" => $article->getIdFournisseur(), "idCouleur" => $article->getIdCouleur(), "idTaille" => $article->getIdTaille(), "idIncrementale" => $article->getIdIncrementale(), "idLot" => $article->getIdLot(), "quantiteStock" => $article->getQuantiteStock(), "prixAchat" => $article->getPrixAchat(), "prixVente" => $prix, "seuil" =>$article->getSeuil()];

echo json_encode($newArticle);
