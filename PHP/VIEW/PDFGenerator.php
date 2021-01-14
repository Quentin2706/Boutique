<?php
require("./FPDF/fpdf.php");
$idClient=$_GET["idClient"];
$idVente=$_GET["idVente"];
$client=Table_clientManager::findById($idClient);
$vente=Table_venteManager::findById($idVente);
$detailVente=Table_detail_venteManager::findByVente($idVente);
$TVA=0.2;
$pdf=new FPDF("P","mm","A4");

$pdf->AddPage();
$pdf->SetFont("Helvetica","B",10);
$pdf->SetTextColor(0,0,128);

$pdf->Write(6,"Date de vente : ".$vente->getDate_vente());
$pdf->Ln(6);
$pdf->Write(6,"Nom du client : ".$client->getNomClient());
$pdf->Ln(6);
$pdf->Write(6,"Adresse postale : ".$client->getAdressePostale());
$pdf->SetFont("Helvetica","IB",10);
$pdf->Text(15,34,"Article");
$pdf->Text(100,34,"Quantit".chr(233));
$pdf->Text(140,34,"Prix unitaire");
$pdf->Text(180,34,"Sous-total");
$ligne=40;
$total=0;
for($i=0;$i<count($detailVente);$i++){
    $pdf->Text(15,$ligne,$detailVente[$i]->getArticle()->getLibelle());
    $pdf->Text(100,$ligne,$detailVente[$i]->getQuantite());
    $pdf->Text(140,$ligne,$detailVente[$i]->getPrixUnitaire());
    $pdf->Text(180,$ligne,$detailVente[$i]->Total());
    $total+=$detailVente[$i]->Total();
    $ligne+=6;
}

$pdf->SetDrawColor(0,0,128);
$pdf->SetLineWidth(1);
$pdf->Rect(12,36,190,$ligne-40);

$pdf->SetDrawColor(0);
$pdf->SetLineWidth(0.2);
$pdf->Rect(175,$ligne,25,10);

$pdf->Text(150,$ligne+6,"Total_vente : ");
$pdf->Text(180,$ligne+6,$total+($total*$TVA).chr(128));

$pdf->Text(150,$ligne+16,"dont TVA : ");
$pdf->Text(180,$ligne+16,$total*$TVA.chr(128));

$pdf->Ln($ligne);
$pdf->Write(6,"Paiement : ");

$pdf->Output("F","./test.pdf");

header("location:./test.pdf");