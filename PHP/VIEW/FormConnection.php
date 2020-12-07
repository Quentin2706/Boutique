<?php

if (!isset($_POST['pseudo'])) // On est dans la page de formulaire
{
    require 'Php/View/HtmlConnection.php'; // On affiche le formulaire
}
else
{ // Le formulaire a été validé

    $message = '';
    if (empty($_POST['pseudo']) || empty($_POST['password'])) // Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	                   Vous devez remplir tous les champs</p>
	                   <p>Cliquez <a href="index.php?action=connection">ici</a> pour revenir</p>';
    }
else // On check le mot de passe
    {
        $utilisateur = UserManager::get($_POST['pseudo']); // On recherche dans la base l'utilisateur et on rempli l'objet user
        if ($utilisateur->getPassword() == md5($_POST['password'])) // Acces OK !
        {
            $_SESSION['pseudo'] = $utilisateur->getPseudo();
            $_SESSION['level'] = $utilisateur->getRole();
            $_SESSION['id'] = $utilisateur->getIdUser();
            header("refresh:0,url=index.php?action=accueil");
        }
    else // Acces pas OK !
        {
            $message = '<p>Une erreur s\'est produite 	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.</p>';
            header("refresh:3,url=index.php?action=connection");
        }
    }
    echo $message;
}
