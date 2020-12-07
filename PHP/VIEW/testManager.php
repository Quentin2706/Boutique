<?php
// Paramètres
$manager = "Article" . "Manager";
$fonction = "findById";
$objet = null;
$args = 2168;

// Affichage
echo "<h1>Test : " . $manager . " / " . $fonction . "()</h1>";
var_dump($manager::$fonction($args));