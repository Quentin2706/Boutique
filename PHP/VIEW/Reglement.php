<?php 
var_dump($_POST);
$paiements = Table_modePaiementManager::getList(); 
?>

<div>
    <div class="ligne">
    <div class="tableau">
        <div class="ligne">
        <div class="enTete">Mode Paiement</div>
                    <div class="enTete">Montant</div>
                    <div class="enTete">Libellé Mode</div>
</div>
    <div class="ligne">
    <div class="contenu">CB</div>
                    <div class="contenu">120€</div>
                    <div class="contenu">Carte Bancaire</div>
    </div>
</div>

    <div id="blocPaiement">
                <div>
                    <label for="moyenPaiement">Mode Paiement</label>
                    <div class="ligne blocPaiement">
                    <select name="moyenPaiement" id="moyenPaiement">
                        <?php 
                            for ($i = 1; $i < count($paiements); $i++)
                            {
                                echo'<option value ='.$paiements[$i]->getIdModePaiement().'>'.$paiements[$i]->getLibModePaiement().'</option>';
                            }
                        ?>
                    </select>
                
                <div class="boutonCaisse boutonPaiement">
                    <img src="./IMG/plus.png">
                </div>
                <div class="boutonCaisse boutonPaiement">
                    <div><img src="./IMG/supprimer.png"></div>
                </div>
                <div class="boutonCaisse boutonPaiement">
                    <img src="./IMG/imprime.png">
                </div>
</div>
</div>
</div>
</div>  

