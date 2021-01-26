<?php
if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 1) {
    echo '

<div class="conteneur">
    <div class="tableau">
        <div class="ligne">
            <div class="enTete">Pseudo Utilisateur</div>
            <div class="enTete">Role utilisateur</div>
            <div class="enTete">
                <div class="miniBouton centrer ligne">
                    <button><a href="index.php?page=Form&table=User&mode=ajout"><img src="./IMG/plus mauve.png" alt="Ajouter"></a></button>
                </div>
            </div>
        </div>';
    $listeUser = Table_userManager::getList();
    for ($i = 0; $i < count($listeUser); $i++) {
        if ($listeUser[$i]->getLibelle() == 1) {
            $role = "Administrateur";
        } else {
            $role = "Vendeur";
        }
        echo '

            <div class="ligne">
                <div class="contenu">' . $listeUser[$i]->getPseudo() . '</div>
                <div class="contenu">' . $role . '</div>
                <div class="contenu ligne">
                    <div class="miniBouton centrer ligne">
                        <button><a href="index.php?page=Form&table=User&mode=modif&id=' . $listeUser[$i]->getIdUser() . '"><img src="./IMG/modifie.png" alt="Modifier Univers"></a></button>
                        <button><a href="index.php?page=Form&table=User&mode=delete&id=' . $listeUser[$i]->getIdUser() . '"><img src="./IMG/supprimer.png" alt="Supprimer Univers"></a></button>
                    </div>
                </div>
            </div>';
    }
    ;
    echo '
    </div>

</div>
</div>';
} else if (isset($_SESSION['user'])) {
    header("location:index.php?page=MenuCaisse");
} else {
    header("location:index.php?page=FormConnexion");
}
