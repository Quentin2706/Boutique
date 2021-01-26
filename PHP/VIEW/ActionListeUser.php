<?php
if (isset($_SESSION['user'])&& $_SESSION['user']->getRole()==1){
$p = new Table_user($_POST);
switch ($_GET['mode']) {
    case "ajout":
        {
            Table_userManager::add($p);
            break;
        }
    case "modif":
        {
            Table_userManager::delete($p);
            $crypte=crypte($_POST["password"]);
            $p=new Table_user(["pseudo"=>$_POST["pseudo"],"password"=>$crypte,"role"=>$_POST["role"]]);
            Table_userManager::add($p);
            break;
        }
    case "delete":
        {
            
            Table_userManager::delete($p);
            break;
        }
}

header("location:index.php?page=ListeUser");
}else  if (isset($_SESSION['user'])){
    header("location:index.php?page=MenuCaisse");
} else {
    header("location:index.php?page=FormConnexion");
}