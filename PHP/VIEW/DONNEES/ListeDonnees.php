<?php
if (isset($_SESSION['user'])&& $_SESSION['user']->getRole()==1){
 echo'<div class="conteneur">
    <div id="menuDeroulant">
        <div>
            <button class="menu">Univers</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisUnivers">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddUnivers">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter un Univers</div>
                </div>
            </div>
        </div>
        <div>
            <button class="menu">Catégorie</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisCateg">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddCateg">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter une Catégorie</div>
                </div>
            </div>
        </div>
        <div>
            <button class="menu">Fournisseur</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisFournisseur">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddFournisseur">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter un Fournisseur</div>
                </div>
            </div>
        </div>
        <div>
            <button class="menu">Couleur</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisCouleur">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddCouleur">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter une Couleur</div>
                </div>
            </div>
        </div>
        <div>
            <button class="menu">Promotions</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisCateg">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddCateg">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter une Catégorie</div>
                </div>
            </div>
        </div>
        <div>
            <button class="menu">Utilisateurs</button>
            <div class="sousMenu">
                <div class="contenuSousMenu ligne" cible="LisUser">
                    <div class="petiteIcon">
                        <img src="./IMG/liste.png" alt="liste"></div>
                    <div> Voir la Liste</div>

                </div>
                <div class="traitViolet"></div>
                <div class="contenuSousMenu ligne" cible="AddUser">
                    <div class="petiteIcon"> <img src="./IMG/plus mauve.png" alt="Ajouter"></div>
                    <div>Ajouter un utilisateur</div>
                </div>
            </div>
        </div>
    </div>
</div>';
} else  if (isset($_SESSION['user'])){
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
?>