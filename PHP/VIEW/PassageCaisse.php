
<?php $clients = Table_clientManager::getList();?>

<div class="colonne">
<div class="ligne">
<div class="blocRecherche ligne">
        <label for="clientCaisse">Client</label>
        <div class="ligne fois2">
        <select name="clientCaisse" id="clientCaisse">
            <?php
for ($i = 0; $i < count($clients); $i++) {
    echo '<option value="' . $clients[$i]->getIdClient() . '">' . $clients[$i]->getNomClient() . '</option>';
}?>
        </select>
</div>
        <div class="ligne">
        <div class="boutonCaisse" >
            <a href="./index.php?page=Form&table=Client&mode=ajout">
            <img src="../IMG/plus.png">
        </a>
        </div>
        <div></div>
        <div class="boutonCaisse " id="mailClient">
            <img src="../IMG/mail.png">
        </div>
        <div></div>
        <div class="boutonCaisse">
            <a href="clients.html">
            <img src="../IMG/personne.png">
        </a>
        </div>
</div>
    </div>
    <div class="fois9"></div>
</div>

    <div class="blocRecherche ligne alignself">
        <div class="colonneCaisse">
            <div class="tableau">
                <div class="ligne">
                    <div class="enTete">Référence</div>
                    <div class="enTete">Article</div>
                    <div class="enTete">Prix U</div>
                    <div class="enTete">Quantité</div>
                    <div class="enTete">Total</div>
                </div>
                <div class="ligne">
                    <div class="contenu"><input name="" value="" autofocus/></div>
                    <div class="contenu">Chaussette</div>
                    <div class="contenu">1</div>
                    <div class="contenu"><input name="" type="number" id="" value=""/></div>
                    <div class="contenu">10</div>
                </div>
            </div>

            <div class="conteneur">
                <div class="blocCaissePrix">
                    <p>Sous-Total</p>
                    <p>Remise</p>
                    <div class="traitNoir"></div>
                    <p>Total</p>
                </div>
            </div>
        </div>
        <div class="colonne fois2">
            <div class="ligne">
                <div class="boutonCaisse">
                    <img src="../IMG/plus.png">
                </div>
                <div class="boutonCaisse">
                    <img src="../IMG/supprimer.png">
                </div>
            </div>
            <div class="ligne">
                <div class="boutonCaisse">
                    <img src="../IMG/remise.png">
                </div>
                <div class="boutonCaisse">
                    <img src="../IMG/imprime.png">
                </div>
            </div>
            <div class="ligne">
                <div class="boutonCaisse" id="paiement">
                    <img src="../IMG/paiement.png">
                </div>
            </div>
        </div>
    </div>
</div>