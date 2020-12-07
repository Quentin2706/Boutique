<?php
class TailleManager
{
    public static function add(Taille $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_taille (libTaille,refTaille) VALUES (:libTaille,:refTaille)");
        $q->bindValue(":libTaille", $obj->getLibTaille());
        $q->bindValue(":refTaille", $obj->getRefTaille());
        $q->execute();
    }

    public static function update(Taille $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_taille SET libTaille=:libTaille, refTaille=:refTaille WHERE idTaille=:idTaille");
        $q->bindValue(":libTaille", $obj->getLibTaille());
        $q->bindValue(":refTaille", $obj->getRefTaille());
        $q->bindValue(":idTaille", $obj->getIdTaille());
        $q->execute();
    }

    public static function delete(Taille $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_taille WHERE idTaille=" . $obj->getIdTaille());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_taille WHERE idTaille=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Taille($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_taille");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Taille($donnees);
            }
        }
        return $tab;
    }

}
