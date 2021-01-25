<?php
require("./FPDF/fpdf.php");
$idClient=$_GET["idClient"];
$idVente=$_GET["idVente"];
creerTicketPDF($idClient,$idVente);

header("location:./Tickets/Ticket".$idVente.".pdf");