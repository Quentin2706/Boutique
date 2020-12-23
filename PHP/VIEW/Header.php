<?php
//Attribution des variables de session
$action = (isset($_GET['action'])) ? $_GET['action'] : '';

?>

<body>
    <header>
        <div class="gauche top">
            <div class="logo">
               <a href="index.php"> <img src="IMG/fleurDeLin.png" alt="logo fleur de lin"></a>
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
                    <img src="IMG/deconnexion.png">
                </a>
            </div><div></div>
        </div>
    </header>
    <div id="container" class="ligne">
<div>
