<?php

#############################################################
#                IMPORT DE PHP SPREADSHEET                  #
#############################################################

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

##########################################################################################################################################
#                                                            PROGRAMME                                                                   #
##########################################################################################################################################

if (isset($_SESSION['user'])&& $_SESSION['user']->getRole()==1){

// on recupere le fichier modele
$gabarit = \PhpOffice\PhpSpreadsheet\IOFactory::load("CSV/Gabarit.xlsx");
$sheet = $gabarit->getActiveSheet();
$auj = new DateTime('NOW');
$auj = $auj->format('Y-m-d');
$nomFichier = "Articles " . $auj;

//on le sauvegarde sous le nom definitif
saveCSV($nomFichier, $gabarit);

$articles=Table_article_CSVManager::getList();
for($i=0;$i<count($articles);$i++){
    $nb=3+$i;
    $ligne="A".$nb.":R".$nb;
    if($i%2==0){
        
        $sheet->getStyle($ligne)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCAD86');
    }else{
        $sheet->getStyle($ligne)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ECE4CE');
    }
    $sheet->setCellValueByColumnAndRow(1, 3 + $i, $articles[$i]->getRefArticle());
    $sheet->setCellValueByColumnAndRow(2, 3 + $i, $articles[$i]->getLibArticle());
    $sheet->setCellValueByColumnAndRow(3, 3 + $i, $articles[$i]->getRefUnivers());
    $sheet->setCellValueByColumnAndRow(4, 3 + $i, $articles[$i]->getLibUnivers());
    $sheet->setCellValueByColumnAndRow(5, 3 + $i, $articles[$i]->getRefCateg());
    $sheet->setCellValueByColumnAndRow(6, 3 + $i, $articles[$i]->getLibCateg());
    $sheet->setCellValueByColumnAndRow(7, 3 + $i, $articles[$i]->getRefFournisseur());
    $sheet->setCellValueByColumnAndRow(8, 3 + $i, $articles[$i]->getLibFournisseur());
    $sheet->setCellValueByColumnAndRow(9, 3 + $i, $articles[$i]->getRefCouleur());
    $sheet->setCellValueByColumnAndRow(10, 3 + $i, $articles[$i]->getLibCouleur());
    $sheet->setCellValueByColumnAndRow(11, 3 + $i, $articles[$i]->getRefTaille());
    $sheet->setCellValueByColumnAndRow(12, 3 + $i, $articles[$i]->getLibTaille());
    $sheet->setCellValueByColumnAndRow(13, 3 + $i, $articles[$i]->getRefIncrementale());
    $sheet->setCellValueByColumnAndRow(14, 3 + $i, $articles[$i]->getReflot());
    $sheet->setCellValueByColumnAndRow(15, 3 + $i, $articles[$i]->getQuantiteStock());
    $sheet->setCellValueByColumnAndRow(16, 3 + $i, $articles[$i]->getPrixAchat());
    $sheet->setCellValueByColumnAndRow(17, 3 + $i, $articles[$i]->getPrixVente());
    $sheet->setCellValueByColumnAndRow(18, 3 + $i, $articles[$i]->getSeuil());
}
saveCSV($nomFichier, $gabarit);

echo '
<div class="centrer">
<a href="index.php?page=Liste&table=article">
    <input type="button" class="bouton centrer" value="Retour"/>
    </a>
</div>';

} else  if (isset($_SESSION['user'])){
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
##########################################################################################################################################
#                                                            FONCTIONS                                                                   #
##########################################################################################################################################

//Fonction qui sauvegarde le fichier
function saveCSV($nomFichier, $spreadsheet)
{
    //Créer le dossier CSV s'il n'existe pas
    if (!is_dir("CSV"))
    {
        mkdir("CSV");
    }
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save("CSV/" . $nomFichier . ".xlsx");
}

