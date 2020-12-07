<?php
class IncrementaleManager
{
    public static function add(Incrementale $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_incrementale (refIncrementale) VALUES (:refIncrementale)");
        $q->bindValue(":refIncrementale", $obj->getRefIncrementale());
        $q->execute();
    }

    public static function update(Incrementale $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_incrementale SET refIncrementale=:refIncrementale WHERE idIncrementale=:idIncrementale");
        $q->bindValue(":refIncrementale", $obj->getRefIncrementale());
        $q->bindValue(":idIncrementale", $obj->getIdIncrementale());
        $q->execute();
    }

    public static function delete(Incrementale $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_incrementale WHERE idIncrementale=" . $obj->getIdIncrementale());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_incrementale WHERE idIncrementale=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Incrementale($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_incrementale");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Incrementale($donnees);
            }
        }
        return $tab;
    }

}
