<?php
if (isset($_SESSION['user'])&& $_SESSION['user']->getRole()==1){
    echo'
<div class="conteneur">
        <div class="bloc">
            <div class="fois5 ligne">
                <div class="grosBouton">
                    <a href="index.php?page=MenuCaisse">
                        <div class="picto caisse">
                            <img src="IMG/caisse.png" alt="Caisse">
                        </div>
                    </a>
                    <div class="nomPicto">Caisse</div>
                </div>
                <div class="grosBouton">
                    <a href="index.php?page=Liste&table=client">
                        <div class="picto clients">
                            <img src="IMG/personne.png" alt="Clients">
                        </div>
                    </a>
                    <div class="nomPicto">Clients</div>
                </div>
            </div>
            <div class="fois5 ligne">
                <div class="grosBouton">
                    <a href="index.php?page=Liste&table=article">
                    <div class="picto articles">
                        <img src="IMG/entrepot.png" alt="Articles">
                    </div>
                </a>
                    <div class="nomPicto">Articles</div>

                </div>
                <div class="grosBouton">
                    <a href="index.php?page=ListeDonnees">
                    <div class="picto donnees">
                        <img src="IMG/data.png" alt="Données">
                    </div>
                </a>
                    <div class="nomPicto">Données</div>

                </div>
            </div>
        </div>
    </div>';
} else  if (isset($_SESSION['user'])){
    header("location:index.php?page=MenuCaisse");
} else {
    header("location:index.php?page=FormConnexion");
}
?>
