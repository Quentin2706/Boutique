<?php
if (isset($_SESSION['user'])) { //S'il est connecté on récupère la table
    $table = 'Table_' . $_GET["table"];
    if ($_SESSION['user']->getRole() == 2 && $table = "Table_client") { //Si c'est un vendeur il ne peut agir que sur les clients
        // on recup la surcharge URL
        $table = $_GET['table'];
        $classe = "Table_Client";
        $objets = appelGetList("Table_" . $table);

        if (empty($objets)) {
            echo 'La table est vide';
        } else {
            echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligne">';
            // le foreach affiche les noms des colonnes du tableau
            $listeLabel = $objets[0]->getListeLabel();
            $nbColonne = $classe::getNbColonne();
            for ($i = 2; $i < $nbColonne; $i++) {
                if ($listeLabel[$i] != "password") {
                    echo '<div class="enTete centrer ">' . $listeLabel[$i] . '</div>';
                }
            }
            echo '<div class="enTete"><div class="miniBouton centrer ligne">
        <button><a href="index.php?page=Form&table=' . $table . '&mode=ajout"><img src="./IMG/plus mauve.png" alt="Ajouter"></a></button>
    </div></div>
    </div>';
            if ($classe != "Table_article") {
                // on recupere les attributs de la classe
                $infos = $classe::getListeAttributs();

                // On parcourt tout les objets pour afficher les differentes informations
                foreach ($objets as $unObjet) {
                    echo '<div class="ligne">';
                    //on vérifie si on doit faire appel à l'objet lié pour afficher le libelle au lieu de la clé secondaire
                    $listeTypeInput = $objets[0]->getListeTypeInput();
                    $listeClasse = $objets[0]->getListeClass();
                    $id = appelGet($unObjet, "id" . $table);
                    // Affichage des information une par une de l'objet
                    for ($i = 2; $i < $nbColonne; $i++) {
                        if ($listeTypeInput[$i] != "password") {
                            if ($listeTypeInput[$i] == "select") {
                                $classe = $listeClasse[$i];
                                $obj = appelFindById($classe, appelGet($unObjet, $infos[$i]));
                                echo '<div class="contenu">' . $obj->getLibelle() . '</div>';
                            } else {
                                echo '<div class="contenu">' . appelGet($unObjet, $infos[$i]) . '</div>';
                            }
                        }
                    }
                    echo '<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><a href="index.php?page=Form&table=' . $table . '&mode=modif&id=' . $id . '"><img src="./IMG/modifie.png" alt="Modifier Univers"></a></button>
            <button><a href="index.php?page=Form&table=' . $table . '&mode=delete&id=' . $id . '"><img src="./IMG/supprimer.png" alt="Supprimer Univers"></a></button>
        </div>
    </div>
</div>';

                }
            }
            echo $classe != "Table_article" ? '</div>' : "";
            echo '</div>
</div>';
        }
    } else {
        // on recup la surcharge URL
        $table = $_GET['table'];
        $classe = "Table_" . $table;
        $objets = appelGetList("Table_" . $table);

        if (empty($objets)) {
            echo 'La table est vide';
        } else {
            // On ajoute le bloc de recherche si la liste a afficher c'est la liste de la table Article. //
            if ($classe == "Table_article") {
                echo '<div class="colonne centrer">
        <div class="blocRecherche">
            <div class="ligneRecherche ligne">
                <div class="centrer">
                    <label for="refArticle">Ref. Article</label>
                    <input name="refArticle" type="text" id="refArticle" class="filtre">
                </div>
                <div class="centrer">
                    <label for="libArticle">Libellé Article</label>
                    <input name="libArticle" type="text" id="libArticle" class="filtre" >
                </div>
                <div class="centrer">
                    <label for="univers">Univers</label>
                    <select name="univers" id="univers" class="filtre">';
                $liste = appelGetList("Table_univers");
                echo '<option value="null"> Rechercher par univers </option>';
                for ($i = 0; $i < count($liste); $i++) {
                    echo '<option value="' . $liste[$i]->getIdUnivers() . '">' . $liste[$i]->getLibUnivers() . '</option>';
                }
                echo '</select>
                </div>
            </div>
            <div class="ligneRecherche ligne">
                <div class="centrer">
                    <label for="categorie">Catégorie</label>
                    <select name="categorie" id="categorie" class="filtre">';
                $liste = appelGetList("Table_categ");
                echo '<option value="null"> Rechercher par catégorie </option>';
                for ($i = 0; $i < count($liste); $i++) {
                    echo '<option value="' . $liste[$i]->getIdCateg() . '">' . $liste[$i]->getLibCateg() . '</option>';
                }
                echo '</select>
                </div>
                <div class="centrer">
                    <label for="couleur">Couleur</label>
                    <select name="couleur" id="couleur" class="filtre">';
                $liste = appelGetList("Table_couleur");
                echo '<option value="null"> Rechercher par couleur </option>';
                for ($i = 0; $i < count($liste); $i++) {
                    echo '<option value="' . $liste[$i]->getIdCouleur() . '">' . $liste[$i]->getLibCouleur() . '</option>';
                }
                echo '</select>
                </div>
                <div class="centrer">
                    <label for="fournisseur">Fournisseur</label>
                    <select name="fournisseur" id="fournisseur" class="filtre">';
                $liste = appelGetList("Table_fournisseur");
                echo '<option value="null"> Rechercher par fournisseur </option>';
                for ($i = 0; $i < count($liste); $i++) {
                    echo '<option value="' . $liste[$i]->getIdFournisseur() . '">' . $liste[$i]->getLibFournisseur() . '</option>';
                }
                echo '</select>
                </div>
            </div>
            <div class="espace">
            </div>
            <div class="centrer">
                <input  class="bouton centrer" type="submit" value="Rechercher" id="recherche">
            </div>
        </div>';
            }

            echo '<div class="conteneurTableau">
<div class="tableau">
    <div class="ligne">';
            // le foreach affiche les noms des colonnes du tableau
            $listeLabel = $objets[0]->getListeLabel();
            $nbColonne = $classe::getNbColonne();
            for ($i = 2; $i < $nbColonne; $i++) {
                if ($listeLabel[$i] != "password") {
                    echo '<div class="enTete centrer ">' . $listeLabel[$i] . '</div>';
                }
            }
            echo '<div class="enTete"><div class="miniBouton centrer ligne">
        <button><a href="index.php?page=Form&table=' . $table . '&mode=ajout"><img src="./IMG/plus mauve.png" alt="Ajouter"></a></button>
    </div></div>
    </div>';
            if ($classe != "Table_article") {
                // on recupere les attributs de la classe
                $infos = $classe::getListeAttributs();

                // On parcourt tout les objets pour afficher les differentes informations
                foreach ($objets as $unObjet) {
                    echo '<div class="ligne">';
                    //on vérifie si on doit faire appel à l'objet lié pour afficher le libelle au lieu de la clé secondaire
                    $listeTypeInput = $objets[0]->getListeTypeInput();
                    $listeClasse = $objets[0]->getListeClass();
                    $id = appelGet($unObjet, "id" . $table);
                    // Affichage des information une par une de l'objet
                    for ($i = 2; $i < $nbColonne; $i++) {
                        if ($listeTypeInput[$i] != "password") {
                            if ($listeTypeInput[$i] == "select") {
                                $classe = $listeClasse[$i];
                                $obj = appelFindById($classe, appelGet($unObjet, $infos[$i]));
                                echo '<div class="contenu">' . $obj->getLibelle() . '</div>';
                            } else {
                                echo '<div class="contenu">' . appelGet($unObjet, $infos[$i]) . '</div>';
                            }
                        }
                    }
                    echo '<div class="contenu ligne">
        <div class="miniBouton centrer ligne">
            <button><a href="index.php?page=Form&table=' . $table . '&mode=modif&id=' . $id . '"><img src="./IMG/modifie.png" alt="Modifier Univers"></a></button>
            <button><a href="index.php?page=Form&table=' . $table . '&mode=delete&id=' . $id . '"><img src="./IMG/supprimer.png" alt="Supprimer Univers"></a></button>
        </div>
    </div>
</div>';

                }
            }
            echo $classe != "Table_article" ? '</div>' : "";
            echo '</div>
</div>';
        }
    }
} else if (isset($_SESSION['user'])) {
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=MenuCaisse">';

} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
