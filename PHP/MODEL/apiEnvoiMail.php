<?php
require "./FPDF/fpdf.php";
$idClient = $_POST["idClient"];
$idVente = $_POST["idVente"];
creerTicketPDF($idClient, $idVente);

$client = Table_clientManager::findById($idClient);
$vente = Table_venteManager::findById($idVente);

//Destinataire
$to = $_POST['mail'];

//Sujet
$subject = 'LBL - Votre ticket de caisse';

//Clé aléatoire de limite
$boundary = md5(uniqid(rand(), true));

// Headers
$headers = 'From: La boutique du Lin <mail@server.com>' . "\r\n";
$headers .= 'Mime-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: multipart/mixed;boundary=' . $boundary . "\r\n";
$headers .= "\r\n";

// Message;
$msg = '';

// Texte
$msg .= '--' . $boundary . "\r\n";
$msg .= 'Content-type:text/plain;charset=utf-8' . "\r\n";
$msg .= 'Content-transfer-encoding:8bit' . "\r\n";
if ($client->getIdClient() != 1) {
    $msg .= 'Bonjour, ' . $client->getNomClient() . ' voici ci-joint la facture du ' . $vente->getDate_vente() . "\r\nMerci pour votre achat à la boutique du lin. A bientôt !" . "\r\n";
} else {
    $msg .= 'Bonjour, voici ci-joint la facture du ' . $vente->getDate_vente() . "\r\nMerci pour votre achat à la boutique du lin. A bientôt !" . "\r\n";
}

// Pièce jointe
$file_name = './Tickets/Ticket' . $_POST["idVente"] . '.pdf';
if (file_exists($file_name)) {
    $file_type = filetype($file_name);
    $file_size = filesize($file_name);

    $handle = fopen($file_name, 'r') or die('File ' . $file_name . 'can t be open');
    $content = fread($handle, $file_size);
    $content = chunk_split(base64_encode($content));
    $f = fclose($handle);

    $msg .= '--' . $boundary . "\r\n";
    $msg .= 'Content-type: application/pdf;name=' . $file_name . "\r\n";
    $msg .= 'Content-transfer-encoding:base64' . "\r\n";
    $msg .= 'Content-Disposition: attachment; filename="' . $file_name . '"' . "\n";
    $msg .= $content . "\r\n";
}

// Fin
$msg .= '--' . $boundary . "\r\n";

// Function mail()
mail($to, $subject, $msg, $headers);
