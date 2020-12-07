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
	"default"=>["PHP/VIEW/","accueil","Accueil"],
	"Testtable_articleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_articleManager","Test de table_article"],
	"Testtable_categManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_categManager","Test de table_categ"],
	"Testtable_clientManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_clientManager","Test de table_client"],
	"Testtable_couleurManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_couleurManager","Test de table_couleur"],
	"Testtable_detail_venteManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_detail_venteManager","Test de table_detail_vente"],
	"Testtable_fournisseurManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_fournisseurManager","Test de table_fournisseur"],
	"Testtable_incrementaleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_incrementaleManager","Test de table_incrementale"],
	"Testtable_lotManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_lotManager","Test de table_lot"],
	"Testtable_modepaiementManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_modepaiementManager","Test de table_modepaiement"],
	"Testtable_paiementManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_paiementManager","Test de table_paiement"],
	"Testtable_promotionManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_promotionManager","Test de table_promotion"],
	"Testtable_tailleManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_tailleManager","Test de table_taille"],
	"Testtable_universManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_universManager","Test de table_univers"],
	"Testtable_userManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_userManager","Test de table_user"],
	"Testtable_venteManager"=>["PHP/MODEL/TESTMANAGER/","Testtable_venteManager","Test de table_vente"],
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