<?php
if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 1) {
    $p = new Table_user($_POST);
    switch ($_GET['mode']) {
        case "ajout":
            {
                if (Table_userManager::findByPseudo($_POST['pseudo']) == false) {
                    $crypte = crypte($_POST["password"]);
                    $p = new Table_user(["pseudo" => $_POST["pseudo"], "password" => $crypte, "role" => $_POST["role"]]);
                    Table_userManager::add($p);
                    // header("location:index.php?page=ListeUser");
                    echo '<meta http-equiv="refresh" content="2;url=index.php?page=ListeUser">';

                } else {
                    echo '<div class="centrer">Le pseudo existe déjà.</div>';
                    // header("Refresh:2;url=index.php?page=Form&table=User&mode=ajout");
                    echo '<meta http-equiv="refresh" content="0;url=index.php?page=Form&table=User&mode=ajout">';
                }
                break;
            }
        case "modif":
            {
                $user = Table_userManager::findByPseudo($_POST['pseudo']);
                //Le pseudo n'est pas utilisé
                if ($user == false) {
                    //Le champ "Mot de passe" a été renseigné
                    if ($_POST['password'] != "") {
                        $crypte = crypte($_POST['password']);
                        Table_userManager::delete($p);
                        $p = new Table_user(["pseudo" => $_POST["pseudo"], "password" => $crypte, "role" => $_POST["role"]]);
                        Table_userManager::add($p);
                        // header("location:index.php?page=ListeUser");
                        echo '<meta http-equiv="refresh" content="0;url=index.php?page=ListeUser">';
                    } else {
                        $mdp = Table_userManager::findById($_POST['idUser'])->getPassword();
                        Table_userManager::delete($p);
                        $p = new Table_user(["pseudo" => $_POST["pseudo"], "password" => $mdp, "role" => $_POST["role"]]);
                        Table_userManager::add($p);
                        // header("location:index.php?page=ListeUser");
                        echo '<meta http-equiv="refresh" content="0;url=index.php?page=ListeUser">';
                    }
                } else {
                    //C'est la même personne
                    if ($user->getIdUser() == $_POST['idUser']) {
                        //Le champ "Mot de passe" a été renseigné
                        if ($_POST['password'] != "") {
                            $crypte = crypte($_POST['password']);
                            Table_userManager::delete($p);
                            $p = new Table_user(["pseudo" => $_POST["pseudo"], "password" => $crypte, "role" => $_POST["role"]]);
                            Table_userManager::add($p);
                            // header("location:index.php?page=ListeUser");
                            echo '<meta http-equiv="refresh" content="0;url=index.php?page=ListeUser">';

                        } else {
                            $mdp = $user->getPassword();
                            Table_userManager::delete($p);
                            $p = new Table_user(["pseudo" => $_POST["pseudo"], "password" => $mdp, "role" => $_POST["role"]]);
                            Table_userManager::add($p);
                            // header("location:index.php?page=ListeUser");
                            echo '<meta http-equiv="refresh" content="0;url=index.php?page=ListeUser">';

                        }
                    } else {
                        echo '<div class="centrer">Le pseudo existe déjà.</div>';
                        // header("Refresh:2;url=index.php?page=Form&table=User&mode=modif&id=" . $_POST['idUser']);
                        echo '<meta http-equiv="refresh" content="0;url=index.php?page=Form&table=User&mode=modif&id="' . $_POST['idUser'] . '">';

                    }
                }
                break;
            }
        case "delete":
            {
                Table_userManager::delete($p);
                // header("location:index.php?page=ListeUser");
                echo '<meta http-equiv="refresh" content="0;url=index.php?page=ListeUser">';

                break;
            }
    }

} else if (isset($_SESSION['user'])) {
    // header("location:index.php?page=MenuCaisse");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=MenuCaisse">';

} else {
    // header("location:index.php?page=FormConnexion");
    echo '<meta http-equiv="refresh" content="0;url=index.php?page=FormConnexion">';

}
