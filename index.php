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

	"FormUser"=>["PHP/VIEW/","FormUser","Formulaire des utilisateurs"],
	"ActionUser"=>["PHP/VIEW/","Actionuser","Action des utilisateurs"],
	"MenuCaisse"=>["PHP/VIEW/","MenuCaisse","Caisse"],
	"ListeVentes"=>["PHP/VIEW/","ListeVentes","Ventes"],
	"PassageCaisse"=>["PHP/VIEW/","PassageCaisse","Caisse"],
	"MailTicket"=>["PHP/VIEW/","MailTicket","Envoie ticket par mail"],
	"Reglement"=>["PHP/VIEW/","Reglement","Caisse"],

	"ListeDonnees"=>["PHP/VIEW/","ListeDonnees","Liste des Données"],

	"ListeArticles"=>["PHP/VIEW/","ListeArticles","Liste des Articles"],
	"FormArticle"=>["PHP/VIEW/","FormArticle","Formulaire des Articles"],
	"ActionArticle"=>["PHP/VIEW/","ActionArticle","Action Article"],

	"FormUnivers"=>["PHP/VIEW/","FormUnivers","Formulaire des Univers"],
	"ActionUnivers"=>["PHP/VIEW/","ActionUnivers","Action des Univers"],

	"Liste"=>["PHP/VIEW/","Liste","Liste des Categories"],
	"FormCategorie"=>["PHP/VIEW/","FormCategories","Formulaire des Categories"],
	"ActionCategorie"=>["PHP/VIEW/","ActionCategories","Action des Categories"],

	"FormFournisseur"=>["PHP/VIEW/","FormFournisseur","Formulaire des Fournisseurs"],
	"ActionFournisseur"=>["PHP/VIEW/","ActionFournisseur","Action des Fournisseurs"],

	"FormCouleur"=>["PHP/VIEW/","FormCouleur","Formulaire des Couleurs"],
	"ActionCouleur"=>["PHP/VIEW/","ActionCouleur","Action des Couleurs"],

	"FormPromotion"=>["PHP/VIEW/","FormPromotion","Formulaire des Promotions"],
	"ActionPromotion"=>["PHP/VIEW/","ActionPromotion","Action des Promotionss"],

	"FormClient"=>["PHP/VIEW/","FormClient","Formulaire des clients"],
	"ActionClient"=>["PHP/VIEW/","ActionClient","Action des clients"],

	"ListeAchatsClients"=>["PHP/VIEW/","ListeAchatsClients","Liste d'achats des clients"],
	"AffichageTicket"=>["PHP/VIEW/","AffichageTicket","Affichage des tickets du client"],

	"Form"=>["PHP/VIEW/","Form","Formulaire"],
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