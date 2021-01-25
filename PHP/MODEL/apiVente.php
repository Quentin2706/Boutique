<?php
$infos=[];
$filtre=json_decode($_POST["filtrageVente"]);
$tab=[
    "dateDebut"=>$filtre->dateDebut,
    "dateFin"=>$filtre->dateFin
];
$ventes=Table_venteManager::apiRech($tab);
for($i=0;$i<count($ventes);$i++){
    $infos[$i]=$ventes["idVente"]
}
echo json_encode(Table_venteManager::apiRech($tab));