<?php
//AJOUTER LES CRYPTAGES ETLES REDIRECTIONS EN FONCTION DES ROLES, PAR DEFAUT LES REDIRECTION DIRIGE VERS MENUCAISSE
$mode = $_GET["mode"];
if ($mode == "inscription") //Si le mode est inscription
{
    $p = Table_userManager::findByPseudo($_POST["pseudo"]);
    if ($p == false) {
        $user = new Table_user(["pseudo" => $_POST["pseudo"], "password" => crypte($_POST["password"]), "role" => 2]);
        Table_userManager::add($user);
        echo '<div class="centrer">Inscription terminée ! Vous allez être redirigé</div>
        ';
        header("Refresh:2;url=index.php?page=FormConnexion", true, 303);
    } else {
        echo '<div class="centrer">Ce pseudo est déjà utilisé.Vous allez être redirigé.</div>
        ';
        header("Refresh:2;url=index.php?page=FormInscription", true, 303);
    }

} else if ($mode == "connexion") { //Si le mode est connexion
    $p = Table_userManager::findByPseudo($_POST["pseudo"]);
    if ($p != false) {
        if (crypte($_POST["password"]) == $p->getPassword()) {
            echo '<div class="centrer">Connexion réussie.Vous allez être redirigé</div>';
            $_SESSION['user'] = $p;
            header("Refresh:2;url=index.php?page=MenuCaisse", true, 303);
        } else {
            echo '<div class="centrer">Mot de passe incorrect.Vous allez être redirigé</div>';
            header("Refresh:2;url=index.php?page=FormConnexion", true, 303);
        }
    } else {
        echo '<div class="centrer">Pseudo incorrect.Vous allez être redirigé</div>';
        header("Refresh:2;url=index.php?page=FormConnexion", true, 303);
    }
} else if ($mode == "deconnexion") {
    session_destroy();
    echo '<div class="centrer">Vous avez été deconnecté.Vous allez être redirigé</div>';
    header("Refresh:2;url=index.php?page=FormConnexion", true, 303);
}
