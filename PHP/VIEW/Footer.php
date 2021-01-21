</div>
</div>
<div class="footer">
<div class="texteFooter">
            <p>©LaBoutiqueDuLin</p>
        </div>
</div>

<footer>
        <div class="texteFooter">
            <p>©LaBoutiqueDuLin</p>
        </div>
    </footer>
    <?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];
    switch ($page) {
        case 'Liste':
            if ($_GET["table"] == "Article") {
                echo '<script src="JS/ListeArticles.js"></script>';
            } else if ($_GET["table"] == "Client") {
                echo '<script src="JS/ListeClients.js"></script>';
            }
            break;
        case 'ListeDonnees':
            echo '<script src="JS/ListeDonnees.js"></script>';
            break;
        case 'ListeVentes':
            echo '<script src="JS/ListeVentes.js"></script>';
            break;
        case 'PassageCaisse':
            echo '<script src="JS/PassageCaisse.js"></script>';
            break;
        case 'Reglement':
            echo '<script src="JS/Reglement.js"></script>';
            break;
        default:
            # code...
            break;
    }
}
?>
</body>


</html>