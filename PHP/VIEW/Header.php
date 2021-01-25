<?php
//Attribution des variables de session
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
?>

<body>
    <header>
    <div>
    <div class="ligne">
    <div class="petitFlex blocBleuBordBlanc button  petiteIcon retour"><a href = "javascript:history.back()"><img id="retour" src="IMG/fleche.png"></a></div>
        <div class="gauche top foisDemi">
            <div class="logo">
               <a href="index.php"> <img src="IMG/fleurDeLin.png" alt="logo fleur de lin"></a>
            </div>
            <div class="foisDemi"></div> 
        </div>
        <div class="foisDemi"></div>
        <div class="centre top">
            <div class="titrePage">
                <p>Accueil</p>
            </div>
        </div>
<div class="recalibreHeader"></div>
        <div class="droite top">
            <div></div>
            <div class="blocBleuBordBlanc button  petiteIcon .retour">
                <a href="index.php?action=deconnection">
                    <img src="IMG/deconnexion.png">
                </a>
            </div>
        </div>
        </div>
        <div class="centrer"></div>
        </div>
    </header>
