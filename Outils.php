<?php
function ChargerClasse($classe)
{
    if (file_exists("PHP/CONTROLLER/" . $classe . ".Class.php")) {
        require "PHP/CONTROLLER/" . $classe . ".Class.php";
    }
    if (file_exists("PHP/MODEL/" . $classe . ".Class.php")) {
        require "PHP/MODEL/" . $classe . ".Class.php";
    }
}
spl_autoload_register("ChargerClasse");

function uri()
{
    $uri = $_SERVER['REQUEST_URI'];
    if (substr($uri, strlen($uri) - 1) == "/") // se termine par /
    {
        $uri .= "index.php?";
    } else if (in_array("?", str_split($uri))) // si l'uri contient deja un ?
    {
        $uri .= "&";
    } else {
        $uri .= "?";
    }
    return $uri;
}

function crypte($mot)
{
    return md5(md5($mot));
}

function texte($codeTexte)
{
    global $lang; //on appel la variable globale
    return TexteManager::findByCodes($lang, $codeTexte);
}

function afficherPage($page)
{
    $chemin = $page[0];
    $nom = $page[1];
    $titre = $page[2];
    if ($page[3]) {
        include $chemin . $nom . '.php';
    } else {
        include 'PHP/VIEW/Head.php';
        include 'PHP/VIEW/Header.php';
        include 'PHP/VIEW/Nav.php';
        include $chemin . $nom . '.php';
        include 'PHP/VIEW/Footer.php';
    }
}

// function optionComboBox($code, $nom)
// {
//     $ref=["Client"=>["id"=> "idClient","libelle"=>"NomClient"]];
//     $select = '<select id="id' . $nom . '" name="id' . $nom . '" >';
//     if ($nom = "Client") {
//         $liste = Table_clientManager::getList();
//     }

//     if ($code == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
//         $select .= '<option value="" SELECTED>Choisir une valeur</option>';
//     }
//     foreach ($liste as $elt) {
//         $methodId = "get" . $ref[$nom]["id"];
//         $methodLibelle = "get" . $ref[$nom]["libelle"];
//         if ($code == $elt->$methodId()) //appel de la methode stockée dans $method
//         { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
//             $select .= '<option value="' . $elt->$methodId() . '" SELECTED>' . $elt->$methodLibelle() . '</option>';
//         } else {
//             $select .= '<option value="' . $elt->$methodId() . '">' . $elt->$methodLibelle() . '</option>';
//         }
//     }
//     $select .= "</select>";
//     return $select;
// }

function optionComboBox($code, $nom, $class, $obj, $mode)
{
    $nom = ucfirst($nom);
    $rId = "getId" . $nom;
    $id = $obj->$rId();
    $listeInfos = $obj->getListeInfos();
    $rLib = "getLib" . $nom;
    $lib = $obj->$rLib();
    $ref = ["$nom" => ["id" => $id, "libelle" => $lib]];
    $select = '<select id="id' . $nom . '" name="id' . $nom . '"';
    if ($mode == "detail" || $mode == "delete") {
        $select .= " disabled ";
    }
    $select .= '>';
    $aux = "Table_" . $nom . "Manager";
    $liste = $aux::getList();

    if ($code == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
        $select .= '<option value="" SELECTED>Choisir une valeur</option>';
    }
    foreach ($liste as $elt) {
        // var_dump($code);
        // echo $code;
        // var_dump($elt->$rId());

        if ($code == $elt->$rId()) //appel de la methode stockée dans $method
        { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
            $select .= '<option value="' . $elt->$rId() . '" SELECTED>' . $elt->$rLib() . '</option>';
        } else {
            $select .= '<option value="' . $elt->$rId() . '">' . $elt->$rLib() . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}

/**
 * fonction qui construit un select en fonction des parametres
 * @valeur : valeur qui sera selected
 * @table : table de reference
 * @nomId : nom de l'id dans la table de reference
 * @$mode : mode ajout modif, edit ou supprime
 */
function optionSelect($valeur, $table, $nomId, $mode)
{
    // $nom = ucfirst($nom);
    // $rId = "getId".$nom;
    // $id = $obj->$rId();
    // $listeInfos = $obj->getListeInfos();
    // $rLib = "getLib".$nom;
    // $lib = $obj->$rLib();
    // $ref=["$nom"=>["id"=> $id ,"libelle"=>$lib]];
    $select = '<select id="' . $nomId . '" name="' . $nomId . '"';
    if ($mode == "detail" || $mode == "delete") {
        $select .= " disabled ";
    }
    $select .= '>';
    $liste = appelGetList("Table_" . $table);

    if ($valeur == null) { // si le code est null, on ne mets pas de choix par défaut avec valeur
        $select .= '<option value="" SELECTED>Choisir une valeur</option>';
    }
    foreach ($liste as $elt) {
        // var_dump($code);
        // echo $code;
        // var_dump($elt->$rId());

        if ($valeur == appelGet($elt, $nomId)) //appel de la methode stockée dans $method
        { // si le code entré en paramètre est égale à l'élément alors c'est celui qui est selectionné
            $select .= '<option value="' . appelGet($elt, $nomId) . '" SELECTED>' . appelGet($elt, "Libelle") . '</option>';
        } else {
            $select .= '<option value="' . appelGet($elt, $nomId) . '">' . appelGet($elt, "Libelle") . '</option>';
        }
    }
    $select .= "</select>";
    return $select;
}

/**
 * Fonction qui renvoi l'objet renvoyé par l'appel de la methode static FindById situé dans le manager de la classe
 * @nomTable : contient le nom de la table / classe
 * @id : contient l'id recherché
 */
function appelFindById($nomTable, $id)
{
    $methode = "Table_" . $nomTable . "Manager::findById";
    // $methode = $nomTable."Manager::findById";
    return call_user_func($methode, $id);
}

function appelGetList($nomTable)
{
    $methode = $nomTable . "Manager::getList";
    return call_user_func($methode);
}
/**
 * Fonction qui renvoi l'objet renvoyé par l'appel de la methode formé de Get et de la chaine de caractere
 * @obj : contient l'objet sur lequel porte l'appel
 * @chaine : contient la partie de la methode apres le get
 * ex: chaine="libelle" on appele la méthode $obj->getLibelle()
 */
function appelGet($obj, $chaine)
{
    $methode = 'get' . ucfirst($chaine);
    return call_user_func(array($obj, $methode));

}

function creerTicketPDF($idClient,$idVente){
$client=Table_clientManager::findById($idClient);
$vente=Table_venteManager::findById($idVente);
$detailVente=Table_detail_venteManager::findByVente($idVente);
$TVA=0.2;
$paiements = Table_paiementManager::findByVente($idVente);
$pdf=new FPDF("P","mm","A4");

$pdf->AddPage();
$pdf->SetFont("Helvetica","B",10);
$pdf->SetTextColor(0,0,128);

$pdf->Write(6,"Date de vente : ".$vente->getDate_vente());
$pdf->Ln(6);
$pdf->Write(6,"Nom du client : ".utf8_decode($client->getNomClient()));
$pdf->Ln(6);
$pdf->Write(6,"Adresse postale : ".$client->getAdressePostale());
$pdf->SetFont("Helvetica","IB",10);
$pdf->Text(15,34,"Article");
$pdf->Text(100,34,"Quantit".chr(233));
$pdf->Text(140,34,"Prix unitaire");
$pdf->Text(180,34,"Sous-total");
$ligne=40;
$total=0;
$pdf->SetTextColor(0);
$pdf->SetFont("Helvetica","",10);
for($i=0;$i<count($detailVente);$i++){
    $pdf->Text(15,$ligne,$detailVente[$i]->getArticle()->getRefArticle());
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
$pdf->SetTextColor(0,0,128);
$pdf->SetFont("Helvetica","IB",10);
$pdf->Text(150,$ligne+6,"Total_vente : ");
$pdf->SetTextColor(0);
$pdf->SetFont("Helvetica","",10);
$pdf->Text(180,$ligne+6,$total.chr(128));
$pdf->SetTextColor(0,0,128);
$pdf->SetFont("Helvetica","IB",10);
$pdf->Text(150,$ligne+16,"dont TVA : ");
$pdf->SetTextColor(0);
$pdf->SetFont("Helvetica","",10);
$pdf->Text(180,$ligne+16,$total*$TVA.chr(128));

$pdf->Ln($ligne);
$ligne = $ligne+26;
$pdf->SetTextColor(131,158,203);
$pdf->SetFont("Helvetica","",10);
$pdf->Write(6,"Paiement : ");
$pdf->SetTextColor(0);
for($i = 0; $i < count($paiements); $i++)
{
    $pdf->Text(30,$ligne,$paiements[$i]->getMontant().chr(128));
    if ($i == 0)
    {
        $pdf->SetTextColor(131,158,203);
        $pdf->SetFont("Helvetica","",10);
        $pdf->Text(45,$ligne,"en : ");
        $pdf->SetTextColor(0);
    }
    $pdf->Text(55,$ligne,utf8_decode($paiements[$i]->getLibModePaiement()));
    $ligne+=6;
}


$pdf->Output("F","./Tickets/Ticket".$idVente.".pdf");
}
