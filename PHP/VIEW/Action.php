<?php
if (isset($_SESSION['user'])) { //S'il est connecté on récupère la table
    $table = 'Table_' . $_GET["table"];
    if ($_SESSION['user']->getRole() == 2 && $table = "Table_client") { //Si c'est un vendeur il ne peut agir que sur les clients
        $p = new $table($_POST);
        switch ($_GET['mode']) {
            case "ajout":
                {
                    Table_clientManager::add($p);
                    break;
                }
            case "modif":
                {

                    Table_clientManager::update($p);
                    break;
                }
            case "delete":
                {

                    Table_clientManager::delete($p);
                    break;
                }
        }

        // header("location:index.php?page=Liste&table=" . $_GET["table"]);
        echo '<meta http-equiv="refresh" content="0;url=index.php?page=Liste&table='.$_GET["table"].'">';
    } else { //Sinon l'administrateur peut agir sur toute les tables
        $manager = $table . 'Manager';
        $p = new $table($_POST);
        switch ($_GET['mode']) {
            case "ajout":
                {
                    $manager::add($p);
                    if (isset($_GET['tag'])){ // Si on créé un nouveau client pendant une vente
                        $idVente=Table_venteManager::findLastByVenteSansParam();
                        echo '<meta http-equiv="refresh" content="0;url=index.php?page=PassageCaisse&idVente='.$idVente.'&tag=encours">';
                    } else {
                       echo '<meta http-equiv="refresh" content="0;url=index.php?page=Liste&table='.$_GET["table"].'">'; 
                    }
                    
                    break;
                }
            case "modif":
                {
                    $manager::update($p);
                    if (isset($_GET['tag'])){ //Si on modifie un client pendant une vente
                        $idVente=Table_venteManager::findLastByVenteSansParam();
                        $idClient=Table_venteManager::findClientByVente($idVente);
                        echo '<meta http-equiv="refresh" content="0;url=index.php?page=PassageCaisse&idVente='.$idVente.'&idClient='.$idClient.'">';
                    } else {
                       echo '<meta http-equiv="refresh" content="0;url=index.php?page=Liste&table='.$_GET["table"].'">'; 
                    }
                    break;
                }
            case "delete":
                {

                    $manager::delete($p);
                    echo '<meta http-equiv="refresh" content="0;url=index.php?page=Liste&table='.$_GET["table"].'">';
                    break;
                    
                }
        }

        // header("location:index.php?page=Liste&table=" . $_GET["table"]);
    }

} else if (isset($_SESSION['user'])) {
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=MenuCaisse">';
} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';
}
