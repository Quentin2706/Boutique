<?php 
if (isset($_GET["page"]))
{
    if ($_GET["page"] == "Liste")
    {
        echo '<nav class="paddingNav">
        <div></div>
        <div class="centrer ligne">
            <div class="boutonNav marginCote paddingNav label">
                <a href="index.php?page=Liste&table=Article" class="blanc">Liste des articles</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Categ" class="blanc">Liste des catégories</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Univers" class="blanc">Liste des univers</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Couleur" class="blanc">Liste des couleurs</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Fournisseur" class="blanc">Liste des fournisseurs</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Promotion" class="blanc">Liste des promotions</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=Client" class="blanc">Liste des clients</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=User" class="blanc">Liste des utilisateurs</a>
            </div>
            
            
            
        
        </div>
        <div></div>
        </nav>';
    }
}
?>
<div id="container" class="ligne">