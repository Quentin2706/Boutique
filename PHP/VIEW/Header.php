<?php
//Attribution des variables de session
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
?>

<body>
    <header>
        <div>
            <div class="ligne">
                <div class="petitFlex blocBleuBordBlanc button  petiteIcon retour"><a
                        href="javascript:history.back()"><img id="retour" alt="Retour" src="IMG/fleche.png"></a></div>
                <div class="gauche top foisDemi">
                    <div class="logo">
                        <a href="index.php"> <img src="IMG/fleurDeLin.png" alt="logo fleur de lin"></a>
                    </div>
                    <div class="foisDemi"></div>
                </div>
                <div class="foisDemi"></div>
                <div class="centre top">
                    <div class="titrePage">
                 <?php echo $titre;?>
                    </div>
                </div>
                <div class="recalibreHeader"></div>
                <div class="droite top">
                    <?php if (isset($_SESSION['user'])){
                        echo '<div></div>
                    <div class="blocBleuBordBlanc button  petiteIcon .retour">
                        <a href="index.php?page=ActionUser&mode=deconnexion">
                            <img src="IMG/deconnexion.png" alt="Deconnexion">
                        </a>
                    </div>';
                    } else {
                        echo '<div></div>
                    <div class="blocBleuBordBlanc button  petiteIcon .retour">
                        <a href="index.php?page=FormConnexion">
                            <img src="IMG/login.png" alt="Connexion">
                        </a>
                    </div>';
                        
                     } ?>
                </div>
            </div>
            <div class="centrer"></div>
        </div>
    </header>
