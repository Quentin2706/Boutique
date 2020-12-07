<?php
class LotManager
{
    public static function add(Lot $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_lot (reflot) VALUES (:reflot)");
        $q->bindValue(":reflot", $obj->getReflot());
        $q->execute();
    }

    public static function update(Lot $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_lot SET reflot=:reflot WHERE idLot=:idLot");
        $q->bindValue(":reflot", $obj->getReflot());
        $q->bindValue(":idLot", $obj->getIdLot());
        $q->execute();
    }

    public static function delete(Lot $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_lot WHERE idLot=" . $obj->getIdLot());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_lot WHERE idLot=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Lot($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_lot");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Lot($donnees);
            }
        }
        return $tab;
    }

}
