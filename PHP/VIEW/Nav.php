<?php 
if (isset($_SESSION['user'])&& $_SESSION['user']->getRole()==1){
if (isset($_GET["page"]))
{
    if ($_GET["page"] == "Liste" || $_GET["page"]=="ListeUser")
    {
        echo '<nav class="paddingNav">
        <div></div>
        <div class="centrer ligne">
            <div class="boutonNav marginCote paddingNav label">
                <a href="index.php?page=Liste&table=article" class="blanc">Liste des articles</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=categ" class="blanc">Liste des catégories</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=univers" class="blanc">Liste des univers</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=couleur" class="blanc">Liste des couleurs</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=fournisseur" class="blanc">Liste des fournisseurs</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=promotion" class="blanc">Liste des promotions</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=Liste&table=client" class="blanc">Liste des clients</a>
            </div>
            <div class="boutonNav marginCote paddingNav label">
            <a href="index.php?page=ListeUser" class="blanc">Liste des utilisateurs</a>
            </div>
            
            
            
        
        </div>
        <div></div>
        </nav>';
    }
}
}
?>
<div id="container" class="ligne">