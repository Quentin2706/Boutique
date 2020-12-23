<?php
$table = 'table_'.$_GET["table"];
$manager = $table.'Manager';
$p = new $table($_POST);
switch ($_GET['mode']) {
    case "ajout":
        {
            $manager::add($p);
            break;
        }
    case "modif":
        {
            
            $manager::update($p);
            break;
        }
    case "delete":
        {
            
            $manager::delete($p);
            break;
        }
}

header("location:index.php?page=Liste&table=".$_GET["table"]);