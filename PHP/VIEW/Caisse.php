<?php 
    echo ' <div class="blocMarronBordVert ligne">
        <label for="clientCaisse" class="foisDemi">Client</label>
    ';
    echo '<div class="fois5">'.optionComboBox("","Client").'</div>';
       echo '
        <div class="blocBleuBordBlanc button reduireBouton petiteIcon" >
            <a href="formClient.html">
            <img src="Images/plus.png">
        </a>
        </div>
        <div class="blocBleuBordBlanc button reduireBouton petiteIcon" id="mailClient">
            <img src="Images/mail.png">
        </div>
        <div class="blocBleuBordBlanc button reduireBouton petiteIcon">
            <a href="clients.html">
            <img src="Images/personne.png">
        </a>
        </div>
    </div>

    <div class="blocMarronBordVert ligne">
        <div class="fois7">
            <div class="tableau">
                <div class="ligne">
                    <div class="blocBleuBordBlanc sansRadius centrer">Référence</div>
                    <div class="blocBleuBordBlanc sansRadius centrer">Article</div>
                    <div class="blocBleuBordBlanc sansRadius centrer">Prix U</div>
                    <div class="blocBleuBordBlanc sansRadius centrer">Quantité</div>
                    <div class="blocBleuBordBlanc sansRadius centrer">Total</div>
                    <div class="blocBleuBordBlanc sansRadius centrer">Actions</div>
                </div>
                <div class="ligne">
                    <div class="blocMarronBordBlanc sansRadius centrer">0000000000</div>
                    <div class="blocMarronBordBlanc sansRadius centrer">Chaussette</div>
                    <div class="blocMarronBordBlanc sansRadius centrer">1</div>
                    <div class="blocMarronBordBlanc sansRadius centrer">10</div>
                    <div class="blocMarronBordBlanc sansRadius centrer">10</div>
                    <div class="blocMarronBordBlanc sansRadius centrer ligne">
                        <div class="blocBleuBordBlanc button  miniIcon">
                            <img src="Images/supprimer.png">
                        </div>
                        <div class="blocBleuBordBlanc button    miniIcon">
                            <img src="Images/remise.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="centrer">
                <div class="blocBeigeBordNoir">
                    <p>Sous-Total</p>
                    <p>Remise</p>
                    <div class="traitNoir"></div>
                    <p>Total</p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="ligneCaisse">       
                <div class="blocBleuBordBlanc button   moyenneIcon">
                    <img src="Images/plus.png">
                </div>
                <div class="blocBleuBordBlanc button    moyenneIcon">
                    <img src="Images/supprimer.png">
                </div>
                <div class="blocBleuBordBlanc button    moyenneIcon">
                    <img src="Images/remise.png">
                </div>
                <div class="blocBleuBordBlanc button    moyenneIcon">
                    <img src="Images/imprime.png">
                </div>
                <div class="blocBleuBordBlanc button    moyenneIcon" id="paiement">
                    <img src="Images/paiement.png">
                </div>
            </div>
        </div>
    </div>
';