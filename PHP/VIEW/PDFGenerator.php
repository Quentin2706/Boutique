<?php
if (isset($_SESSION['user'])){
require("./FPDF/fpdf.php");
$idClient=$_GET["idClient"];
$idVente=$_GET["idVente"];
creerTicketPDF($idClient,$idVente);

header("location:./Tickets/Ticket".$idVente.".pdf");
}else {
    header("location:index.php?page=FormConnexion");
}