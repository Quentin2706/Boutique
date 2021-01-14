<?php

require("./Outils.php");

Parametres::init();

DbConnect::init();

session_start();

/******Les langues******/
/***On récupère la langue***/
if (isset($_GET['lang']))
{
	$_SESSION['lang'] = $_GET['lang'];
}

/***On récupère la langue de la session/FR par défaut***/
$lang=isset($_SESSION['lang']) ? $_SESSION['lang'] : 'FR';
/******Fin des langues******/

$routes=[
	"default"=>["PHP/VIEW/","accueil","Accueil",false],
	"Testtable_articleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_articleManager","Test de table_article",false],
	"Testtable_categManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_categManager","Test de table_categ",false],
	"Testtable_clientManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_clientManager","Test de table_client",false],
	"Testtable_couleurManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_couleurManager","Test de table_couleur",false],
	"Testtable_detail_venteManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_detail_venteManager","Test de table_detail_vente",false],
	"Testtable_fournisseurManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_fournisseurManager","Test de table_fournisseur",false],
	"Testtable_incrementaleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_incrementaleManager","Test de table_incrementale",false],
	"Testtable_lotManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_lotManager","Test de table_lot",false],
	"Testtable_modepaiementManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_modepaiementManager","Test de table_modepaiement",false],
	"Testtable_paiementManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_paiementManager","Test de table_paiement",false],
	"Testtable_promotionManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_promotionManager","Test de table_promotion",false],
	"Testtable_tailleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_tailleManager","Test de table_taille",false],
	"Testtable_universManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_universManager","Test de table_univers",false],
	"Testtable_userManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_userManager","Test de table_user",false],
	"Testtable_venteManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_venteManager","Test de table_vente",false],

	"FormUser"=>["PHP/VIEW/","FormUser","Formulaire des utilisateurs",false],
	"ActionUser"=>["PHP/VIEW/","Actionuser","Action des utilisateurs",false],
	"MenuCaisse"=>["PHP/VIEW/","MenuCaisse","Caisse",false],
	"ListeVentes"=>["PHP/VIEW/","ListeVentes","Ventes",false],
	"PassageCaisse"=>["PHP/VIEW/","PassageCaisse","Caisse",false],
	"MailTicket"=>["PHP/VIEW/","MailTicket","Envoie ticket par mail",false],
	"Reglement"=>["PHP/VIEW/","Reglement","Caisse",false],

	"ListeDonnees"=>["PHP/VIEW/DONNEES/","ListeDonnees","Liste des Données",false],

		
	"Liste"=>["PHP/VIEW/","Liste","Liste",false],
	"ListeAchats"=>["PHP/VIEW/","ListeAchats","Liste desd Achats",false],
	"Form"=>["PHP/VIEW/","Form","Formulaire",false],
	"Action"=>["PHP/VIEW/","Action","Action",false],

	
	"ListeAchatsClients"=>["PHP/VIEW/","ListeAchatsClients","Liste d'achats des clients",false],
	"AffichageTicket"=>["PHP/VIEW/","AffichageTicket","Affichage des tickets du client",false],

	"apiArticle"=>["PHP/MODEL/","apiArticle","APIARTICLE",true],
	"ticketAchats"=>["PHP/VIEW/","ticketAchats","ticketAchats",true],
	"reader"=>["PHP/VIEW/","reader","reader",true],
];

if(isset($_GET["page"]))
{

	$page=$_GET["page"];

	if(isset($routes[$page]))
	{
		AfficherPage($routes[$page]);
	}
	else
	{
		AfficherPage($routes["default"]);
	}
}
else
{
	AfficherPage($routes["default"]);
}