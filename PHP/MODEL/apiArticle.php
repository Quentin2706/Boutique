<?php
$filtrage = json_decode($_POST["filtrage"]);
$tablo=Table_articleManager::apiRech($filtrage);
//Création d'un nouveau tableau, impossible d'utilisater et de mettre à jour $tablo
$nouvTab=[];
// ce qu'il faut récupérer libellé univers , libelleCateg, libelle Couleur, libelle fournisseur, libelle taille, libelle incrementale, libelle lot
foreach($tablo as $elt){
    //On récupère l'article grace à l'id de celui ci
    $article=Table_articleManager::findById($elt["idArticle"]);
    //On récupère les libellés des clés étrangères
    $univers=$article->getLibUnivers();
    $categ=$article->getLibCateg();
    $fournisseur=$article->getLibFournisseur();
    $couleur=$article->getLibCouleur();
    $taille=$article->getLibTaille();
    $incr=$article->getLibIncrementale();
    $lot=$article->getLibLot();
    
    //On remplace les données par les libellés
    $elt["idUnivers"]=$univers;
    $elt["idCateg"]=$categ;
    $elt["idFournisseur"]=$fournisseur;
    $elt["idCouleur"]=$couleur;
    $elt["idTaille"]=$taille;
    $elt["idIncrementale"]=$incr;
    $elt["idLot"]=$lot;


    //On insère les nouvelles données dans le nouveau tableau
    $nouvTab[]=$elt;

}
echo json_encode($nouvTab);