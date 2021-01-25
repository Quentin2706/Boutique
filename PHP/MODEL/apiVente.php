<?php
$infos=[];
$filtre=json_decode($_POST["filtrageVente"]);
$tab=[
    "dateDebut"=>$filtre->dateDebut,
    "dateFin"=>$filtre->dateFin
];
$ventes=Table_venteManager::apiRech($tab);
for($i=0;$i<count($ventes);$i++){
    $client=Table_clientManager::findById($ventes[$i]["idClient"]);
    $conclusionVente = Table_paiementManager::findByVente($ventes[$i]["idVente"]);
    $infos[$i]=["idVente"=>$ventes[$i]["idVente"],"date_vente"=>$ventes[$i]["date_vente"],"client"=>$client->getNomClient(), "conclusionVente"=> $conclusionVente];
}
echo json_encode($infos);