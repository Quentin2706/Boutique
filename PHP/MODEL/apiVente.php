<?php
$filtre=json_decode($_POST["filtrageVente"]);
$tab=[
    "dateDebut"=>$filtre->dateDebut,
    "dateFin"=>$filtre->dateFin
];
echo json_encode(Table_venteManager::apiRech($tab));