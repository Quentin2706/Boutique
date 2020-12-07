<?php
class VenteManager
{
    public static function add(Vente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_vente (date_vente,idClient) VALUES (:date_vente,:idClient)");
        $q->bindValue(":date_vente", $obj->getDate_vente());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->execute();
    }

    public static function update(Vente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_vente SET date_vente=:date_vente, idClient=:idClient WHERE idVente=:idVente");
        $q->bindValue(":date_vente", $obj->getDate_vente());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->execute();
    }

    public static function delete(Vente $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_vente WHERE idVente=" . $obj->getIdVente());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_vente WHERE idVente=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Vente($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_vente");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Vente($donnees);
            }
        }
        return $tab;
    }

}
