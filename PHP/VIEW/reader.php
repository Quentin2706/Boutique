<?php
require './vendor/autoload.php';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::load('test.pdf');
// $spreadsheet = $reader->load("toto.html");
$writer =\PhpOffice\PhpSpreadsheet\IOFactory::createWriter($reader, "Mpdf");
$writer->drawText("toto");
$writer->save("test.pdf");
// var_dump($writer);