<?php

#############################################################
#                IMPORT DE PHP SPREADSHEET                  #
#############################################################

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

##########################################################################################################################################
#                                                            PROGRAMME                                                                   #
##########################################################################################################################################

// on recupere le fichier modele
$gabarit = \PhpOffice\PhpSpreadsheet\IOFactory::load("CSV/Gabarit.xlsx");
$sheet = $gabarit->getActiveSheet();
$auj = new DateTime('NOW');
$auj = $auj->format('Y-m-d');
$nomFichier = "Articles " . $auj;

//on le sauvegarde sous le nom definitif
saveCSV($nomFichier, $gabarit);


