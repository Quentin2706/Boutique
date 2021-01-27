<?php
if (isset($_SESSION['user'])){
echo'
<div></div>
<div class="conteneur">
    <div>
        <div class="blocMC">
            <a href="index.php?page=ListeVentes">
            <div class="boutonMenuCaisse">
                <img src="./IMG/loupe.png" class="logoBtn"><p>Rechercher une Vente</p>
            </div>
            </a>
            <a href="index.php?page=PassageCaisse">
            <div class="boutonMenuCaisse">
                <img src="./IMG/caisse.png" class="logoBtn"><p>Aller à la Caisse</p>
        </div>
        </a>
    </div>
</div>
</div>
<div></div>';
}else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
