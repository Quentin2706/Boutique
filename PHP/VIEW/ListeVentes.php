<?php
if (isset($_SESSION['user'])) {
    $date = new DateTime('NOW');
    $auj = $date->format('Y-m-d');
    $ventes = Table_venteManager::findByDate($auj);
    echo '
<div class="colonne">
  <div class="blocRecherche alignself">
    <div class="ligneRecherche ligne">
      <div class="marginCote centrer">
        <label for="dateDebut ">Du</label>
        <input name="dateDebut" type="date" id="dateDebut" value="' . $auj . '">
      </div>
      <div class="marginCote centrer">
        <label for="dateFin">Au</label>
        <input name="dateFin" type="date" id="dateFin" value="' . $auj . '">
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
        </div>
      </div>
    </div>

  </div>
</div>';
} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
