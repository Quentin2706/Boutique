<?php
$date=new DateTime('NOW');
$auj=$date->format('Y-m-d');
$ventes=Table_venteManager::findByDate($auj);
?>
<div class="colonne">
  <div class="blocRecherche alignself">
    <div class="ligneRecherche ligne">
      <div class="marginCote centrer">
        <label for="dateDebut ">Du</label>
        <input name="dateDebut" type="date" id="dateDebut" value="<?php echo $auj?>">
      </div>
      <div class="marginCote centrer">
        <label for="dateFin">Au</label>
        <input name="dateFin" type="date" id="dateFin" value="<?php echo $auj?>">
      </div>
    </div>
    <div class="espace"></div>
    <div class="centrer">
      <input class="bouton centrer" type="submit" value="Rechercher">
    </div>
  </div>
  <div class="blocCaisse centrer">
    <div class="blocRecherche ligne">
      <div class="colonneCaisse">
        <div class="tableau">
          <div class="ligne" id="hautTableau">
            <div class="enTete">Nom du client</div>
            <div class="enTete">Date Achat</div>
            <div class="enTete">N° Vente</div>
            <div class="enTete">Ticket</div>
          </div>
          <?php
            
            for ($i=0;$i<count($ventes);$i++)
            {
                echo '
                <div class="ligne">
                <div class="contenu">'.$ventes[$i]->getClient()->getNomClient().'</div>
                    <div class="contenu">'.$ventes[$i]->getDate_vente().'</div>
                    <div class="contenu">'.$ventes[$i]->getIdVente().'</div>
                    <div class="contenu">
              <div class="miniBouton">
                <a href="./Tickets/Ticket'.$ventes[$i]->getIdVente().'" target="_blank" ><button><img src="./IMG/voir.png" alt="Voir Ticket"></button></a>
              </div>
            </div>
                </div>';
            };
          ?>
        </div>
      </div>
    </div>

  </div>
</div>