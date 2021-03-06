<?php

class Table_universManager
{
    public static function add(Table_univers $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_univers (refUnivers,libUnivers) VALUES (:refUnivers,:libUnivers)");
        $q->bindValue(":refUnivers", $obj->getRefUnivers());
        $q->bindValue(":libUnivers", $obj->getLibUnivers());
        $q->execute();
    }

    public static function update(Table_univers $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_univers SET idUnivers=:idUnivers,refUnivers=:refUnivers,libUnivers=:libUnivers WHERE idUnivers=:idUnivers");
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->bindValue(":refUnivers", $obj->getRefUnivers());
        $q->bindValue(":libUnivers", $obj->getLibUnivers());
        $q->execute();
    }
    public static function delete(Table_univers $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_univers WHERE idUnivers=" . $obj->getIdUnivers());
    }
    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_univers WHERE idUnivers =" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Table_univers($results);
        } else {
            return false;
        }
    }
    public static function getList()
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query("SELECT * FROM table_univers");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_univers($donnees);
            }
        }
        return $liste;
    }
    public static function findByReference($ref)
    {
        $db = DbConnect::getDb();
        if (!in_array(";", str_split($ref))) // s'il n'y a pas de ; , je lance la requete
        {
            $q = $db->query("SELECT * FROM table_univers WHERE refUnivers =" . $ref);
            $results = $q->fetch(PDO::FETCH_ASSOC);
            if ($results != false) {
                return new Table_univers($results);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
