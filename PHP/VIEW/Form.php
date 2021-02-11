<?php
if (isset($_SESSION['user'])) { //S'il est connecté on récupère la table
    $table = 'Table_' . $_GET["table"];
    if ($_SESSION['user']->getRole() == 2 && $table = "Table_client") { //Si c'est un vendeur il ne peut agir que sur les clients
        // on recup la surcharge URL
        $table = $_GET['table'];
        $classe = "Table_Client";
        $mode = $_GET['mode'];
        if ($mode != "ajout") {
            $id = $_GET['id'];
            // En fonction de la surchage on fait l'action appropriée
            $objet = appelFindById($table, $id);
        }
// Pour l'ajout il faut quand même les listes d'info lié aux objets donc on récupère un objet de la table pour avoir les infos
        else {
            $objet = appelFindById($table, 1); // gestion de l'ajout
        }
        $labels = $classe::getListeLabel();
        $infos = $classe::getListeAttributs();
        $listeClass = $classe::getListeClass();
        $input = $classe::getListeTypeInput();
        echo '<div class="conteneur">
<div class="blocform">';
        if ($_GET['table'] == 'User') {
            echo '<form action="index.php?page=ActionListeUser&mode=' . $mode . '" method="POST">
    <div class="colonne">';
        } else {
            if (isset($_GET['tag'])){ // Si on vient de créé un client ou modifier pendant une vente
                echo '<form action="index.php?page=Action&table=' . $table . '&mode=' . $mode . '&tag=encours" method="POST">';
            } else {
                echo '<form action="index.php?page=Action&table=' . $table . '&mode=' . $mode . '" method="POST">';
            }
            echo'
        <div class="colonne">';
        }

// On ajoute l'id en caché si on est pas en ajout
        if ($mode != "ajout") {
            echo '<input name="' . $infos[1] . '" type="hidden" id="' . appelGet($objet, $infos[1]) . '" value="' . appelGet($objet, $infos[1]) . '"/>';
        }

// On affiche tout les champs à renseigner
        for ($i = 2; $i < count($labels); $i++) { //on commmence à 2 car l'id est déja traité avant (index 1 des tableaux)
            echo '<div>';
            echo '<label for="' . $infos[$i] . '">' . $labels[$i] . '</label>';

            // Si le label est un select alors on utilise la fonction comboBox
            if ($input[$i] == "select") {
                if ($_GET['table'] == 'User') {
                    //SELECT DE LA TABLE USER
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $user = Table_userManager::findById($id);
                        if ($user->getRole() == 1) {
                            echo '
            <select name="role">
                <option value="1" selected>Administrateur</option>
                <option value="2">Vendeur</option>
            </select>';
                        } else {
                            echo '
            <select name="role">
                <option value="1">Administrateur</option>
                <option value="2" selected>Vendeur</option>
            </select>';
                        }
                    } else {
                        echo '
            <select name="role">
                <option value="1">Administrateur</option>
                <option value="2">Vendeur</option>
            </select>';
                    }

                } else {
                    if ($mode == "ajout") {
                        // echo optionComboBox(null,$listeClass[$i],"",$objet,$mode);
                        echo optionSelect(null, $listeClass[$i], $infos[$i], $mode);
                    } else {
                        echo optionSelect(appelGet($objet, $infos[$i]), $listeClass[$i], $infos[$i], $mode);
                    }
                }
            }
            // Input simple
            else {
                echo '<input name="' . $infos[$i] . '" type="' . $input[$i] . '" required';
                if ($mode != "ajout") {
                    if ($infos[$i] != "password") {
                        echo ' value= "' . appelGet($objet, $infos[$i]) . '"';
                    } else {
                        echo ' value= ""';
                    }
                }
                // Insertions des données si on n'est pas dans ajout
                if ($mode == "detail" || $mode == "delete") {
                    echo ' disabled';
                }
                // Désactivation des champs pour le mode détail et supprimer
                echo '/>';
            }
            echo '</div>';
            echo '<div class="espace"></div>';
        }

        echo '<div class="espace"></div>
<div class="centrer ligne">';
        switch ($mode) {
            case "ajout":echo '<input  class="bouton centrer" type="submit" value="Ajouter">';
                break;
            case "modif":echo '<input  class="bouton centrer" type="submit" value="Modifier">';
                break;
            case "delete":echo '<input  class="bouton centrer" type="submit" value="Supprimer">';
                break;
        }
        if ($_GET['table'] == 'User') {
            echo '<div class="foisDemi"></div><a href="index.php?page=ListeUser"><input  class="bouton centrer" value="Annuler"></a>';
        } else {
            echo '<div class="foisDemi"></div><a href="index.php?page=Liste&table=' . $table . '"><input  class="bouton centrer" value="Annuler"></a>';
        }

        echo '
</div>

</div>
</form>
</div>

</div>';
    } else {
        $table = $_GET['table'];
        $classe = "Table_" . $table;
        $mode = $_GET['mode'];
        if ($mode != "ajout") {
            $id = $_GET['id'];
            // En fonction de la surchage on fait l'action appropriée
            $objet = appelFindById($table, $id);
        }
// Pour l'ajout il faut quand même les listes d'info lié aux objets donc on récupère un objet de la table pour avoir les infos
        else if ($table == "modepaiement") { //gestion de l'ajout modePaiement
            $objet = appelFindById($table, "CB");
        } else {
            $objet = appelFindById($table, 1); // gestion de l'ajout
        }
        $labels = $classe::getListeLabel();
        $infos = $classe::getListeAttributs();
        $listeClass = $classe::getListeClass();
        $input = $classe::getListeTypeInput();
        echo '<div class="conteneur">
<div class="blocform">';
        if ($_GET['table'] == 'User') {
            echo '<form action="index.php?page=ActionListeUser&mode=' . $mode . '" method="POST">
    <div class="colonne">';
        } else {
            if (isset($_GET['tag'])){ // Si on vient de créé un client pendant une vente
                echo '<form action="index.php?page=Action&table=' . $table . '&mode=' . $mode . '&tag=encours" method="POST">';
            } else {
                echo '<form action="index.php?page=Action&table=' . $table . '&mode=' . $mode . '" method="POST">';
            }
            echo'
        <div class="colonne">';
        }

// On ajoute l'id en caché si on est pas en ajout
        if ($mode != "ajout") {
            echo '<input name="' . $infos[1] . '" type="hidden" id="' . appelGet($objet, $infos[1]) . '" value="' . appelGet($objet, $infos[1]) . '"/>';
        }

// On affiche tout les champs à renseigner
        for ($i = 2; $i < count($labels); $i++) { //on commmence à 2 car l'id est déja traité avant (index 1 des tableaux)
            echo '<div>';
            echo '<label for="' . $infos[$i] . '">' . $labels[$i]; 
            if ($_GET["table"]=="User" && $labels[$i]=="Mot de passe")
            {
                echo ' (Renseigner UNIQUEMENT ce champ si vous voulez changer de mot de passe)';
            }
            echo '</label>';

            // Si le label est un select alors on utilise la fonction comboBox
            if ($input[$i] == "select") {
                if ($_GET['table'] == 'User') {
                    //SELECT DE LA TABLE USER
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $user = Table_userManager::findById($id);
                        if ($user->getRole() == 1) {
                            echo '
            <select name="role">
                <option value="1" selected>Administrateur</option>
                <option value="2">Vendeur</option>
            </select>';
                        } else {
                            echo '
            <select name="role">
                <option value="1">Administrateur</option>
                <option value="2" selected>Vendeur</option>
            </select>';
                        }
                    } else {
                        echo '
            <select name="role">
                <option value="1">Administrateur</option>
                <option value="2">Vendeur</option>
            </select>';
                    }

                } else {
                    if ($mode == "ajout") {
                        // echo optionComboBox(null,$listeClass[$i],"",$objet,$mode);
                        echo optionSelect(null, $listeClass[$i], $infos[$i], $mode);
                    } else {
                        echo optionSelect(appelGet($objet, $infos[$i]), $listeClass[$i], $infos[$i], $mode);
                    }
                }
            }
            // Input simple
            else {
                echo '<input name="' . $infos[$i] . '" type="' . $input[$i] . '"';
                if ($infos[$i]!="password"){
                    echo 'required';
                }

                if ($mode != "ajout") {
                    if ($infos[$i] != "password") {
                        echo ' value= "' . appelGet($objet, $infos[$i]) . '"';
                    } else {
                        echo ' value= ""';
                    }
                }
                // Insertions des données si on n'est pas dans ajout
                if ($mode == "detail" || $mode == "delete") {
                    echo ' disabled';
                }
                // Désactivation des champs pour le mode détail et supprimer
                echo '/>';
            }
            echo '</div>';
            echo '<div class="espace"></div>';
        }

        echo '<div class="espace"></div>
<div class="centrer ligne">';
        switch ($mode) {
            case "ajout":echo '<input  class="bouton centrer" type="submit" value="Ajouter">';
                break;
            case "modif":echo '<input  class="bouton centrer" type="submit" value="Modifier">';
                break;
            case "delete":echo '<input  class="bouton centrer" type="submit" value="Supprimer">';
                break;
        }
        if ($_GET['table'] == 'User') {
            echo '<div class="foisDemi"></div><a href="index.php?page=ListeUser"><input  class="bouton centrer" value="Annuler"></a>';
        } else {
            echo '<div class="foisDemi"></div><a href="index.php?page=Liste&table=' . $table . '"><input  class="bouton centrer" value="Annuler"></a>';
        }

        echo '
</div>

</div>
</form>
</div>

</div>';
    }
} else if (isset($_SESSION['user'])) {
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=MenuCaisse">';

    
} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
