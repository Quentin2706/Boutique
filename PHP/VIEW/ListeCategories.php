<?php

$categories = Table_categManager::getList();

echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligne">
        <div class="enTete">Référence Catégories</div>
        <div class="enTete">Libellé Catégories</div>
        <div class="enTete">Référence Univers</div>
        <div class="enTete"></div>
    </div>';
    foreach($categories as $uneCategorie)
    {
        echo'<div class="ligne">';
        echo'<div class="contenu">'.$uneCategorie->getRefCateg().'</div>
        <div class="contenu">'.$uneCategorie->getLibCateg().'</div>
        <div class="contenu">'.$uneCategorie->getUnivers()->getRefUnivers().'</div>';
        echo'<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><img src="./IMG/modifie.png" alt="Modifier Univers"></button>
            <button><img src="./IMG/supprimer.png" alt="Supprimer Univers"></button>
        </div>
    </div>
</div>';

    }

echo'</div>
</div>';