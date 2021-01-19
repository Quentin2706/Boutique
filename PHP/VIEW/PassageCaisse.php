
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
            <img src="./IMG/plus.png">
        </a>
        </div>
        <div></div>
        <div class="boutonCaisse " id="mailClient">
            <img src="./IMG/mail.png">
        </div>
        <div class="invisible absoluteMail">
            <?php 
                echo "Adresse mail non renseignée";
            ?>
        </div>
        <div></div>
        <div class="boutonCaisse">
            <a href="index.php?page=Form&table=client&mode=modif&id=0">
            <img src="./IMG/personne.png">
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
                    <div class="enTete supprLigne"></div>
                    <div class="enTete supprLigne"></div>
                    <div class="enTete">Référence</div>
                    <div class="enTete">Article</div>
                    <div class="enTete">Prix unitaire</div>
                    <div class="enTete">Quantité</div>
                    <div class="enTete">Total</div>
                </div>
                <div class="ligne">
                    <div class="supprLigne"><img src="./IMG/supprimer.png"></div>
                    <div class="supprLigne"><img src="./IMG/remise.png"></div>
                    <div class="contenu"><input name="" value="" autofocus class="redimInput" /></div>
                    <div class="contenu"></div>
                    <div class="contenu"></div>
                    <div class="contenu"><input name="" type="number" id="" value="" class="redimInput" disabled/></div>
                    <div class="contenu"></div>
                </div>
            </div>

            <div class="conteneur">
                <div class="blocCaissePrix">
                    <div class="lignePC">
                        <div class="fois2">
                        <p>Sous-Total</p>
                        </div>
                        <div>0</div>
                        <div class="colonneCaisse"></div>
                    </div>
                    <div class="lignePC">
                    <div class="fois2">
                        <p>Remise</p>
                    </div>
                        <div id="remise">0%</div>
                        <div class="colonneCaisse"></div>
                    </div>
                    <div class="traitNoir"></div>
                    <div class="lignePC">
                    <div class="fois2">
                        <p>Total</p>
                        </div>
                        <div>0</div>
                        <div class="colonneCaisse"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="colonne fois2">
            <div class="ligne">
                <div class="boutonCaisse">
                    <img src="./IMG/supprimer.png">
                </div>
            </div>
            <div class="ligne">
                <div class="boutonCaisse">
                    <img src="./IMG/remise.png">
                </div>
                <div class="boutonCaisse">
                    <img src="./IMG/imprime.png">
                </div>
            </div>
            <div class="ligne">
                <div class="boutonCaisse" id="paiement">
                    <img src="./IMG/paiement.png">
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- POP UP Remise sur Ligne -->
<div id="modalRemiseLigne" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="ligneModal">
        <div></div>
        <span class="close">&times;</span>
    </div>

    <div class="ligneModal centrer">
        <div class="label">Remise : </div>
        <div class="fois2">
            <input  type="texte" >
        </div>
        <div class="flexRemise">
            <select class="redimInput">
                <option value="euro">€</option>
                <option value="pourcentage">%</option>
            </select>
        </div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Reférence de la remise :</div>
        <div class="fois2">
            <div id="referenceRemiseLigne"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Prix total : </div>
        <div class="fois2">
            <div id="prixTotalRemiseLigne"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    
    <div class="ligneModal centrer">
        <div class="label">Montant de la remise : </div>
        <div class="fois2">
            <div id="montantRemiseLigne"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Prix total après remise : </div>
        <div class="fois2">
            <div id="prixTotalApresRemiseLigne"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal">
        <input  type="submit" value="Ajouter la remise">
    </div>
  </div>

</div>

