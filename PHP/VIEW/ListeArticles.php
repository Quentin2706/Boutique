<?php

$categories = Table_categorieManager::getList();

echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligneTableau">
        <div class="enTete">Référence Catégories</div>
        <div class="enTete">Libellé Catégories</div>
        <div class="enTete">Référence Univers</div>
        <div class="enTete"></div>
    </div>';
    foreach($categories as $uneCategorie)
    {
        echo'<div class="ligneTableau">';
        echo'<div class="contenu">'.$uneCategorie->getRefCateg().'</div>
        <div class="contenu">'.$uneCategorie->getLibCateg().'</div>
        <div class="contenu">'.$uneCategorie->getUnivers()->getRefUnivers().'</div>';
        echo'<div class="contenu">
        <div class="miniBouton">
            <button><img src="../Images/modifie.png" alt="Modifier Univers"></button>
        </div>
        <div class="miniBouton">
            <button><img src="../Images/supprimer.png" alt="Supprimer Univers"></button>
        </div>
    </div>
</div>';

    }

echo'</div>
</div>';