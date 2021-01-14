<?php
$id = $_GET['id'];
$client = Table_clientManager::findById($id);
$tabAchat = Table_venteManager::findListByClient($client);
    echo'
    <div class="ligne">
    <div></div>
    <div class="conteneur fois7">
        <div class="ligne">
            <div class="enTete">Date Achat</div>
            <div class="enTete">N° Vente</div>
            <div class="enTete">Ticket</div>
        </div>';
        for($i = 0; $i<count($tabAchat);$i++)
        {
            echo'<div class="ligne">
                    <div class="contenu">'.$tabAchat[$i]->getDate_vente().'</div>
                    <div class="contenu">'.$tabAchat[$i]->getIdVente().'</div>
                    <div class="contenu">
                    <div class="miniBouton">
                        <button><img src="./IMG/voir.png" alt="Voir Ticket"></button>
                    </div>
                    </div>
                    </div>';
        }
        echo'</div><div></div></div>';

