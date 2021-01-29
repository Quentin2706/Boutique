<?php
if (isset($_SESSION['user'])) {
    $clients = Table_clientManager::getListSort();
    if (isset($_GET["idVente"])) {
        $detailsVente = Table_detail_venteManager::findByVente($_GET["idVente"]);
    }
    echo '
<div class="colonne">
<div class="ligne">
<div class="blocRecherche ligne">
        <label for="clientCaisse">Client</label>
        <div class="ligne fois2">
        <select name="clientCaisse" id="clientCaisse">';

    for ($i = 0; $i < count($clients); $i++) {
        echo '<option value="' . $clients[$i]->getIdClient() . '"';
        if ($clients[$i]->getIdClient() == 1) {
            echo "selected";
        }

        echo '>' . $clients[$i]->getNomClient() . '</option>';
    }
    echo '
        </select>
</div>
        <div class="ligne">
        <div class="boutonCaisse" >
            <a href="./index.php?page=Form&table=client&mode=ajout">
            <img src="./IMG/plus.png">
        </a>
        </div>
        <div></div>
        <div class="boutonCaisse " id="mailClient">
            <img src="./IMG/mail.png">
        </div>
        <div class="invisible absoluteMail">
            Adresse mail non renseignée
        </div>
        <div></div>
        <div class="boutonCaisse">
            <a href="">
            <img src="./IMG/personne.png">
        </a>
        </div>
</div>
    </div>
    <div class="fois9"></div>
</div>

    <div class="blocRecherche alignself">
        <div class="ligneModal">
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
                        <div class="enTete">Quantité restante</div>
                    </div>';
    //Si c'est une vente en cours on rempli le ticket avec les informations de la vente
    if (isset($_GET["idVente"])) {

        for ($i = 0; $i < count($detailsVente); $i++) {
            //Gestion de l'attribut remise sur la ligne
            if ($detailsVente[$i]->getArticle()->getIdArticle() != "4462" && $detailsVente[$i]->getArticle()->getIdArticle() != "4477") {
                //on regarde si on est pas en offset sur le tableau des lignes
                if ($i + 1 < count($detailsVente)) {
                    //si la ligne suivante est une remise alors la ligne actuelle prend l'attribut remise
                    if ($detailsVente[$i + 1]->getArticle()->getIdArticle() == "4477") {
                        echo '<div class="ligne" remise="">';
                    } else {
                        echo '<div class="ligne">';
                    }

                } else {
                    echo '<div class="ligne">';
                }
                $quantiteStock=$detailsVente[$i]->getArticle()->getQuantiteStock()+$detailsVente[$i]->getQuantite(); //La quantité en stock avec la quantité prise par la vente
                echo '
                                        <div class="supprLigne"><img src="./IMG/supprimer.png"></div>
                                        <div class="supprLigne"><img src="./IMG/remise.png"></div>
                                        <div class="contenu"><input name="" value="' . $detailsVente[$i]->getArticle()->getRefArticle() . '"class="redimInput" disabled/></div>
                                        <div class="contenu">' . $detailsVente[$i]->getArticle()->getLibArticle() . '</div>
                                        <div class="contenu">' . $detailsVente[$i]->getArticle()->getPrixVente() . '</div>
                                        <div class="contenu"><input name="" type="number" id="" value="' . $detailsVente[$i]->getQuantite() . '" class="redimInput"/></div>
                                        <div class="contenu">' . $detailsVente[$i]->getArticle()->getPrixVente() * $detailsVente[$i]->getQuantite() . '</div>
                                        <div class="contenu">'.$quantiteStock.'</div>
                                    </div>';
            } else if ($detailsVente[$i]->getArticle()->getIdArticle() == "4477") { //Si c'est une remise sur la ligne
                $remise = (float) substr($detailsVente[$i]->getPrixUnitaire(), 1);
                $totalRemise = $detailsVente[$i - 1]->getArticle()->getPrixVente() * $detailsVente[$i - 1]->getQuantite() - $remise;
                echo '<div class="ligneRemise">
                                        <div class="supprLigne"><img src="./IMG/supprimer.png"></div>
                                        <div class="contenu">Ref. de la remise : ' . $detailsVente[$i]->getArticle()->getRefArticle() . '</div>
                                        <div class="contenu">Remise : ' . $remise . "€" . '</div>
                                        <div class="contenu">Montant de la remise : ' . $remise . "€" . '</div>
                                        <div class="contenu">Total après remise : ' . $totalRemise . '€</div>
                                    </div>';
            }
        }
    }
    echo '
                    <div class="ligne">
                        <div class="supprLigne"><img src="./IMG/supprimer.png"></div>
                        <div class="supprLigne"><img src="./IMG/remise.png"></div>
                        <div class="contenu"><input name="" value="" autofocus class="redimInput" /></div>
                        <div class="contenu"></div>
                        <div class="contenu"></div>
                        <div class="contenu"><input name="" type="number" id="" value="" class="redimInput" disabled/></div>
                        <div class="contenu"></div>
                        <div class="contenu"></div>
                    </div>
                </div>


            </div>
            <div class="colonne fois2 max">
                <div class="ligne">
                    <div class="foisDemi"></div>
                    <div class="boutonCaisse">
                        <img src="./IMG/supprimer.png">
                    </div>
                    <div class="foisDemi"></div>
                </div>
                <div class="ligne">
                    <div class="foisDemi"></div>
                    <div class="boutonCaisse">
                        <img src="./IMG/remise.png">
                    </div>
                    <div class="foisDemi"></div>
                </div>
            </div>
        </div>
        <div class="conteneur ligneModal">
                <div></div>
                <div class="blocCaissePrix foisDemi">
                    <div class="lignePC">
                        <div class="fois2">
                        <p>Sous-Total</p>
                        </div>
                        <div></div>
                        <div>0€</div>
                        <div class="colonneCaisse"></div>
                    </div>
                    <div class="lignePC">
                        <div class="fois2">
                            <p>Remise</p>
                        </div>
                        <div></div>';
    if (isset($_GET["idVente"])) {
        for ($i = 0; $i < count($detailsVente); $i++) {
            if ($detailsVente[$i]->getArticle()->getIdArticle() == "4462") {
                echo '<div>' . substr($detailsVente[$i]->getPrixUnitaire(), 1) . '€</div>';
            } else {
                echo '<div id="remise">0%</div>';
            }
        }
    } else {
        echo '<div id="remise">0%</div>';
    }
    echo '
                        <div class="colonneCaisse"></div>
                    </div>
                    <div class="traitNoir"></div>
                    <div class="lignePC">
                    <div class="fois2">
                        <p>Total</p>
                        </div>
                        <div></div>
                        <div>0€</div>
                        <div class="colonneCaisse"></div>
                    </div>
                </div>
                <div class="ligne max">
                <a>
                    <div class="boutonCaisse" id="paiement">
                        <img src="./IMG/paiement.png">
                    </div>
                    </a>
                    <div class="fois5"></div>
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
            <input  type="texte" id="inputRemiseLigne">
        </div>
        <div class="flexRemise">
            <select class="redimInput" id="selectTypeRemise">
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
        <input id="submitRemiseLigne" type="submit" value="Ajouter la remise">
    </div>
  </div>

</div>

 <!-- POP UP Remise TOTAL -->
 <div id="modalRemiseTotale" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <div class="ligneModal">
        <div></div>
        <span class="close">&times;</span>
    </div>

    <div class="ligneModal centrer">
        <div class="label">Remise : </div>
        <div class="fois2">
            <input type="texte" id="inputRemiseTotale">
        </div>
        <div class="flexRemise">
            <select class="redimInput" id="selectTypeRemiseTotale">
                <option value="euro">€</option>
                <option value="pourcentage">%</option>
            </select>
        </div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Montant de la remise : </div>
        <div class="fois2">
            <div id="montantRemiseTotale"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Prix total avant remise : </div>
        <div class="fois2">
            <div id="prixTotalAvantRemiseTotale"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal centrer">
        <div class="label">Prix total après remise : </div>
        <div class="fois2">
            <div id="prixTotalApresRemiseTotale"></div>
        </div>
        <div class="flexRemise"></div>
    </div>
    <div class="ligneModal">
        <input id="submitRemiseTotale" type="submit" value="Ajouter la remise totale du ticket ">
    </div>
</div>';
} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
