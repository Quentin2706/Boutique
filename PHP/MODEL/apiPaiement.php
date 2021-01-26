<?php
require("./FPDF/fpdf.php");
$informations = json_decode($_POST["paiement"]);
$idClient = $informations->idClient;
$idVente = $informations->idVente;
$tabPaiement = $informations->tabModePaiement;
for ($i = 0; $i < count($tabPaiement); $i++)
{
    if(count($tabPaiement[$i]) == 2)
    {
        Table_paiementManager::add( new Table_paiement(["idVente" => $idVente, "idModePaiement"=> $tabPaiement[$i][0], "montant" => $tabPaiement[$i][1], "idClient" => $idClient, "banque" => ""]));
    }else {
        Table_paiementManager::add( new Table_paiement(["idVente" => $idVente, "idModePaiement"=> $tabPaiement[$i][0], "montant" => $tabPaiement[$i][1], "idClient" => $idClient, "banque" => $tabPaiement[$i][2]]));
    }
}
creerTicketPDF($idClient,$idVente);