<?php
$informations = json_decode($_POST["infos"]);
if(isset($_POST["idVente"])){
    $idVente=json_decode($_POST["idVente"]);
    //Si la vente était en attente alors on la retrouve et on la supprime pour la recréer avec toute les nouvelles informations
    $detailsVente=Table_detail_venteManager::findByVente($idVente);
    for($i=0;$i<count($detailsVente);$i++){
        var_dump($detailsVente[$i]);
        Table_detail_venteManager::delete($detailsVente[$i]); //On supprime tout les details ventes lié à la vente
    }
    Table_venteManager::delete(Table_venteManager::findById($idVente)); // On supprime la vente
}

$date = new DateTime('NOW');
$auj = $date->format('Y-m-d');
$idClient = $informations->idClient;



$newVente = new Table_vente(["date_vente" => $auj, "idClient" => $idClient]);
$ajout = Table_venteManager::add($newVente);




$tabLignes = $informations->lignesTicket;
$idVente = Table_venteManager::findLastByVente($newVente);

// on parcourt toutes les lignes
for ($i = 0; $i < count($tabLignes); $i++) {
    $article = Table_articleManager::findByReference($tabLignes[$i][0]);
    $nouvLigneTicket = new Table_detail_vente(["idVente" => $idVente, "quantite" => $tabLignes[$i][1], "idArticle" => $article->getIdArticle(), "prixUnitaire" => $article->getPrixVente(), "detailDivers" => ""]);
    Table_detail_venteManager::add($nouvLigneTicket);
    // ON VERIFIE SI C'EST UNE REMISE SUR L'ARTICLE
    if (count($tabLignes[$i]) > 2) {

        $remiseLigneTicket = new Table_detail_vente(["idVente" => $idVente, "quantite" => 1, "idArticle" => 4477, "prixUnitaire" => (float) ("-" . $tabLignes[$i][2]), "detailDivers" => "Remise sur article"]);

        Table_detail_venteManager::add($remiseLigneTicket);
    }
}
// ******************   Remise TOTALE ! *****************************  //
$remise=(float)substr($informations->remise,0,strlen($informations->remise)-1);
$sousTotal=(float)substr($informations->sousTotal,0,strlen($informations->sousTotal)-1);
if ($remise!=0){
    if(strstr($informations->remise,"€")=="€"){
        $remiseTotale=$remise;
    } else{
        $remiseTotale=round($sousTotal*($remise/100),2);
    }
    
    $ligneRemiseTotale = new Table_detail_vente(["idVente" => $idVente, "quantite" => 1, "idArticle" => 4462, "prixUnitaire" => (float) ("-" . $remiseTotale), "detailDivers" => "Remise sur la vente"]);

    Table_detail_venteManager::add($ligneRemiseTotale);
}


