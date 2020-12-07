<?php
class PromotionManager
{
    public static function add(Promotion $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_promotion (idCateg,dateDebut,dateFin,taux) VALUES (:idCateg,:dateDebut,:dateFin,:taux)");
        $q->bindValue(":idCateg", $obj->getIdCateg());
        $q->bindValue(":dateDebut", $obj->getDateDebut());
        $q->bindValue(":dateFin", $obj->getDateFin());
        $q->bindValue(":taux", $obj->getTaux());
        $q->execute();
    }

    public static function update(Promotion $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_promotion SET idCateg=:idCateg, dateDebut=:dateDebut, dateFin=:dateFin, taux=:taux WHERE idPromotion=:idPromotion");
        $q->bindValue(":idCateg", $obj->getIdCateg());
        $q->bindValue(":dateDebut", $obj->getDateDebut());
        $q->bindValue(":dateFin", $obj->getDateFin());
        $q->bindValue(":taux", $obj->getTaux());
        $q->bindValue(":idPromotion", $obj->getIdPromotion());
        $q->execute();
    }

    public static function delete(Promotion $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_promotion WHERE idPromotion=" . $obj->getIdPromotion());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_promotion WHERE idPromotion=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Promotion($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_promotion");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Promotion($donnees);
            }
        }
        return $tab;
    }

}
