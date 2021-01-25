<?php
require("./FPDF/fpdf.php");
$idClient=$_POST["idClient"];
$idVente=$_POST["idVente"];
creerTicketPDF($idClient,$idVente);

$client=Table_clientManager::findById($idClient);
$vente=Table_venteManager::findById($idVente);

// On va dabors définir le fichier à envoyer et à qui
$fichier = './Tickets/ticket'.$_POST["idVente"].'.pdf';
$destinataire=$_POST["mail"];
$sujet = 'LBL - Votre ticket de caisse';

// On créer un boundary unique
$boundary = md5(uniqid(rand(), true));

// On met les entêtes
$entetes = 'Content-Type: multipart/mixed;'."n".' boundary="'.$boundary.'"';
$body = 'This is a multi-part message in MIME format.'."n";
$body .= '--'.$boundary."n";

//Texte
$body .= "n";
$body .= 'Content-Type: text/html; charset="UTF-8"'."n";
$body .= 'Bonjour,'.$client->getNomClient().'
Voici ci-joint la facture du '.$vente->getDate_vente();
$body .= "n";
$body .= '--'.$boundary."n";

//Piece jointe
//entete piece jointe
$body .= 'Content-Type: application/pdf; name="'.$fichier.'"'."n";
$body .= 'Content-Transfer-Encoding: base64'."n";
$body .= 'Content-Disposition: attachment; filename="'.$fichier.'"'."n";
//récupération fichier et encodage
$body .= "n";
$source = file_get_contents($fichier);
$source = base64_encode ($source);
$source = chunk_split($source);
$body .= $source;

// On ferme la dernière partie :
$body .= "n".'--'.$boundary.'--';



// On envoi le mail :
$test=mail($destinataire, $sujet, $body, $entetes);

// var_dump($_POST);
// $test=mail($destinataire, "Confirmation d'inscription", "Bienvenue sur notre site");
var_dump($test);
