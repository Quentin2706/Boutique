<?php
class UniversManager
{
    public static function add(Univers $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_univers (refUnivers,libUnivers) VALUES (:refUnivers,:libUnivers)");
        $q->bindValue(":refUnivers", $obj->getRefUnivers());
        $q->bindValue(":libUnivers", $obj->getLibUnivers());
        $q->execute();
    }

    public static function update(Univers $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_univers SET refUnivers=:refUnivers, libUnivers=:libUnivers WHERE idUnivers=:idUnivers");
        $q->bindValue(":refUnivers", $obj->getRefUnivers());
        $q->bindValue(":libUnivers", $obj->getLibUnivers());
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->execute();
    }

    public static function delete(Univers $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_univers WHERE idUnivers=" . $obj->getIdUnivers());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_univers WHERE idUnivers=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Univers($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_univers");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Univers($donnees);
            }
        }
        return $tab;
    }

}
