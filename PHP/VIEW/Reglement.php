<?php
if (isset($_SESSION['user'])) {
    $paiements = Table_modepaiementManager::getList();
    $client = Table_clientManager::findById($_GET["idClient"]);
    $total = $_GET["total"];
    $vente = Table_venteManager::findLastByClient($client);
    echo '
<div>
    <input type="text" name="idVente" value="'.$vente->getIdVente().'" class="invisible">
    <input type="text" name="idClient" value="'.$client->getIdClient().'" class="invisible">
    <div class="ligne">
        <div class="tableau">
            <div class="ligne">
                <div class="enTete supprLigne "><img class="mediaImage" src="./IMG/supprimer.png"></div>
                <div class="enTete">Mode Paiement</div>
                <div class="enTete">Montant</div>
                <div class="enTete">Libellé Mode</div>
                <div class="enTete">Banque</div>
            </div>

            <div class="ligne">
                <div class="supprLignePrem"> <img src="./IMG/supprimer.png"> </div>
                <div class="contenu">CB</div>
                <div class="contenu"><input class="inputLigne redimInput premierInput" pattern="[0-9]+(.[0-9][0-9]?)?" value="'.substr($total,0,-3).'"/></div>'; //On fait -3 puisque l'ASCII de l'euro est 128 
                echo '
                <div class="contenu">Carte Bleue</div>
                <div class="contenu"></div>
            </div>

        </div>

        <div id="blocPaiement">
            <div>
                <label for="moyenPaiement">Mode Paiement</label>
                <div class="ligne blocPaiement">
                    <select name="moyenPaiement" id="moyenPaiement">';
    for ($i = 1; $i < count($paiements); $i++) {
        echo '<option value ="' . $paiements[$i]->getIdModePaiement().'"';
        if ($paiements[$i]->getIdModePaiement()=="CB"){
            echo 'selected';
        }
         echo '>' . $paiements[$i]->getLibModePaiement() . '</option>';
    }
    echo '
                    </select>

                    <div class="boutonCaisse boutonPaiement">
                        <img src="./IMG/plus.png">
                    </div>
                    <div class="boutonCaisse boutonPaiement">
                        <div><img src="./IMG/supprimer.png"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="conteneur">
        <div class="ligne">
            <div></div>
            <div class="centrer blocRecherche">
                <div class="ligne">
                    <div class="fois2"></div>
                    <div class="centrer">
                        <p>Total Règlement :</p>
                    </div>
                    <div class="centrer" id="totalReglement">0€</div>
                    <div class="fois2"></div>
                </div>
                <div class="ligne">
                    <div class="fois2"></div>
                    <div class="centrer">
                        <p>Reste dû :</p>
                    </div>
                    <div class="centrer" id="resteDu">';
                        echo $total;
                    echo'</div>
                    <div class="fois2"></div>
                </div>

            </div>
            <div></div>
        </div>
    </div>
    <div class="ligne">
        <div class="fois2"></div>
        <div class="boutonCaisse payer centrer">
            Payer
        </div>
        <div class="fois2"></div>
    </div>

    <!-- POP UP Demande envoi mail -->
    <div id="modalEnvoiMail" class="modal">

        <!-- Modal content -->
        <div class="modal-content" id="modalMail">
            <div class="ligneModal">
                <div></div>
                <span class="close">&times;</span>
            </div>

            <div class="centrer">
                <div class="label">Envoyez ticket par Mail : </div>
                <div class="fois2">
                    <input type="texte" id="inputMailClient" pattern="[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}"';if ($client->getAdresseMail() == "") {
        echo "required";
    } else {
        echo 'value="' . $client->getAdresseMail() . '"';
    }
    echo '/>
                </div>
            </div>
            <div class="ligneModal">
                <div class="ligneModal">
                    <div class="centrer"><input id="submitEnvoiMail" type="submit" value="Envoyer avec mail" class=" redimInput texteCenter centrer"></div>
                    <div class="centrer"><input id="submitSansMail" type="submit" value="Envoyer sans mail" class="  redimInput texteCenter centrer"></div>
                </div>
            </div>
        </div>

    </div>';
} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';
}
