<?php
$informations = json_decode($_POST["infos"]);

$date = new DateTime('NOW');
$auj = $date->format('Y-m-d');
$idClient = $informations->idClient;
$newVente = new Table_vente(["date_vente" => $auj, "idClient" => $idClient]);
$ajout = Table_venteManager::add($newVente);

$tabLignes = $informations->lignesTicket;
$idVente = Table_venteManager::findLastByVente($newVente);

for ($i = 0; $i < count($tabLignes); $i++) {
    $article = Table_articleManager::findByReference($tabLignes[$i][0]);
    $nouvLigneTicket = new Table_detail_vente(["idVente" => $idVente, "quantite" => $tabLignes[$i][1], "idArticle" => $article->getIdArticle(), "prixUnitaire" => $article->getPrixVente(), "detailDivers" => ""]);
    Table_detail_venteManager::add($nouvLigneTicket);
    if (count($tabLignes[$i]) > 2) {

        $remiseLigneTicket = new Table_detail_vente(["idVente" => $idVente, "quantite" => 1, "idArticle" => 4477, "prixUnitaire" => (int) ("-" . $tabLignes[$i][2]), "detailDivers" => "Remise sur article"]);

        Table_detail_venteManager::add($remiseLigneTicket);
    }
}
$remise=(int)substr($informations->remise,0,strlen($informations->remise)-1);
$type=substr($informations->remise,strlen($informations->remise)-1);
$sousTotal=(int)substr($informations->sousTotal,0,strlen($informations->sousTotal)-1);
if ($remise!=0){
    if($type=="€"){
        $remiseTotale=$sousTotal-$remise;
    } else{
        $remiseTotale=$sousTotal-$sousTotal*$remise/100;
    }
    
    $ligneRemiseTotale = new Table_detail_vente(["idVente" => $idVente, "quantite" => 1, "idArticle" => 4462, "prixUnitaire" => (int) ("-" . $remiseTotale), "detailDivers" => "Remise sur la vente"]);

    Table_detail_venteManager::add($ligneRemiseTotale);
}


