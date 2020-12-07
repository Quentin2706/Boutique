<?php
class ModePaiementManager
{
    public static function add(ModePaiement $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_modepaiement (libModePaiement) VALUES (:libModePaiement)");
        $q->bindValue(":libModePaiement", $obj->getLibModePaiement());
        $q->execute();
    }

    public static function update(ModePaiement $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_modepaiement SET libModePaiement=:libModePaiement WHERE idModePaiement=:idModePaiement");
        $q->bindValue(":libModePaiement", $obj->getLibModePaiement());
        $q->bindValue(":idModePaiement", $obj->getIdModePaiement());
        $q->execute();
    }

    public static function delete(ModePaiement $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_modepaiement WHERE idModePaiement=" . $obj->getIdModePaiement());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_modepaiement WHERE idModePaiement=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new ModePaiement($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_modepaiement");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new ModePaiement($donnees);
            }
        }
        return $tab;
    }

}
