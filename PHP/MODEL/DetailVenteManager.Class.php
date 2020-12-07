<?php
class DetailVenteManager
{
    public static function add(DetailVente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_detail_vente (idVente,quantite,idArticle,prixUnitaire,detailDivers) VALUES (:idVente,:quantite,:idArticle,:prixUnitaire,:detailDivers)");
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->bindValue(":quantite", $obj->getQuantite());
        $q->bindValue(":idArticle", $obj->getIdArticle());
        $q->bindValue(":prixUnitaire", $obj->getPrixUnitaire());
        $q->bindValue(":detailDivers", $obj->getDetailDivers());
        $q->execute();
    }

    public static function update(DetailVente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_detail_vente SET idVente=:idVente, quantite=:quantite, idArticle=:idArticle, prixUnitaire=:prixUnitaire, detailDivers=:detailDivers WHERE idDetailVente=:idDetailVente");
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->bindValue(":quantite", $obj->getQuantite());
        $q->bindValue(":idArticle", $obj->getIdArticle());
        $q->bindValue(":prixUnitaire", $obj->getPrixUnitaire());
        $q->bindValue(":detailDivers", $obj->getDetailDivers());
        $q->bindValue(":idDetailVente", $obj->getIdDetailVente());
        $q->execute();
    }

    public static function delete(DetailVente $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_detail_vente WHERE idDetailVente=" . $obj->getIdDetailVente());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_detail_vente WHERE idDetailVente=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new DetailVente($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_detail_vente");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new DetailVente($donnees);
            }
        }
        return $tab;
    }

}
