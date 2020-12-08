<?php
// on recup la surcharge URL
$table = $_GET['table']; 
// En fonction de la surchage on fait l'action appropriée
switch ($table) {
    case "univers":
        {
            $objets = Table_universManager::getList();
            break;
        }
    case "fournisseur":
        {
            $objets = Table_fournisseurManager::getList();
            break;
        }
    case "couleur":
        {
            $objets = Table_couleurManager::getList();
            break;
        }
    case "promotion":
        {
            $objets = Table_promotionManager::getList();
            break;
        }
    case "client":
        {
            $objets = Table_clientManager::getList();
            break;
        }
    case "categ":
        {
            $objets = Table_categManager::getList();
            break;
        }
    case "article":
        {
            $objets = Table_articleManager::getList();
            break;
        }
    case "detail_vente":
        {
            $objets = Table_detail_venteManager::getList();
            break;
        }
    case "lot":
        {
            $objets = Table_lotManager::getList();
            break;
        }
    case "paiement":
        {
            $objets = Table_paiementManager::getList();
            break;
        }
    
}
if (empty($objets)){
    echo 'La table est vide';
} else {
echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligne">';
    // le foreach affiche les noms des colonnes du tableau 
        foreach ($objets[0]->getListeLabel() as $unLabel)
        {
            echo'<div class="enTete">'.$unLabel.'</div>';
        }
        echo'<div class="enTete"></div>
    </div>';
    // On parcourt tout les objets pour afficher les differentes informations
foreach ($objets as $unObjet) {
    echo '<div class="ligne">';
    // Affichage des information une par une de l'objet
    for ($i = 2; $i<count($unObjet->getListeInfos()); $i++)
    {
        // on créer la variable methode qui permet de get l'attribut de l'objet
        $methode = "get".ucFirst($unObjet->getListeInfos()[$i]);
        echo'<div class="contenu">'.$unObjet->$methode().'</div>';
    }
    echo '<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><img src="./IMG/modifie.png" alt="Modifier Univers"></button>
            <button><img src="./IMG/supprimer.png" alt="Supprimer Univers"></button>
        </div>
    </div>
</div>';

}

echo '</div>
</div>';
}
