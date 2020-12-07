<?php
//Attribution des variables de session
$action = (isset($_GET['action'])) ? $_GET['action'] : '';

?>

<body>
    <header>
        <div class="gauche top">
            <div class="logo">
                <img src="Images/fleurDeLin.png" alt="logo fleur de lin">
            </div>
        </div>

        <div class="centre top">
            <div class="titrePage">
                <p>Accueil</p>
            </div>
        </div>

        <div class="droite top">
            <div></div>
            <div class="blocBleuBordBlanc button  petiteIcon">
                <a href="index.php?action=deconnection">
                    <img src="Images/deconnexion.png">
                </a>
            </div><div></div>
        </div>
    </header>
    <div id="container">
<div></div>
<div>
