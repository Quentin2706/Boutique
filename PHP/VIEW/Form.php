<?php

// on recup la surcharge URL
$table = $_GET['table'];
$id = $_GET['id'];
$mode = $_GET['mode'];
// En fonction de la surchage on fait l'action appropriée
switch ($table) {
    case "univers":
        {
            $objet = Table_universManager::findById($id);
            break;
        }
    case "fournisseur":
        {
            $objet = Table_fournisseurManager::findById($id);
            break;
        }
    case "couleur":
        {
            $objet = Table_couleurManager::findById($id);
            break;
        }
    case "promotion":
        {
            $objet = Table_promotionManager::findById($id);
            break;
        }
    case "client":
        {
            $objet = Table_clientManager::findById($id);
            break;
        }
    case "categ":
        {
            $objet = Table_categManager::findById($id);
            break;
        }
    case "article":
        {
            $objet = Table_articleManager::findById($id);
            break;
        }
    case "detail_vente":
        {
            $objet = Table_detail_venteManager::findById($id);
            break;
        }
    case "lot":
        {
            $objet = Table_lotManager::findById($id);
            break;
        }
    case "paiement":
        {
            $objet = Table_paiementManager::findById($id);
            break;
        }
    
}

echo '<div class="conteneur">
<div class="blocform">
    <form action="index.php?page=Actions.php&mode='.$mode.'" method="POST">
        <div class="colonne">';
        
        // On ajoute l'id en caché si on est pas en ajout
        if($mode!="ajout"){
            echo '<input name="'.$objet->getListeInfos()[1].'" type="hidden" id="'.$objet->getListeInfos()[1].'" value="'.$objet->getIdCateg().'"/>';
        }

        $labels=$objet->getListeLabel();
        $infos=$objet->getListeInfos();
        $input=$objet->getListeTypeInput();
        // On affiche tout les champs à renseigner
        for($i=0;$i<count($labels);$i++){
            echo '<div>';
            echo '<label for="'.$infos[$i+2].'">'.$labels[$i].'</label>';

            // Si le label est un select alors on utilise la fonction comboBox
            if($input[$i]=="select"){
                if($mode=="ajout"){
                    echo optionComboBox(null,$infos[$i+2],"",$objet,$mode);
                }
                else{
                    $methode="get".$infos[$i+2];
                    echo optionComboBox($objet->$methode(),$infos[$i+2],"",$objet,$mode);
                }
                
            }

            // Input simple
            else{
                echo '<input name="'.$infos[$i+2].'" type="'.$input[$i].'" id="'.$infos[$i+2].'" required';
                $methode="get".$infos[$i+2];
                if($mode != "ajout") echo ' value= "'.$objet->$methode().'"'; // Insertions des données si on n'est pas dans ajout
                if($mode=="detail" || $mode=="delete") echo ' disabled'; // Désactivation des champs pour le mode détail et supprimer
                echo '/>';
            }
            echo '</div>';
            echo '<div class="espace"></div>';
        }


echo '<div class="espace"></div>
<div class="centrer">
    <input  class="bouton centrer" type="submit" value="Ajouter">
</div>

</div>
</form>
</div>

</div>';
?>



                    


                    