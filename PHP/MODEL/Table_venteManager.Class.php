<?php

class Table_venteManager
{
    public static function add(Table_vente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO Table_vente (date_vente,idClient) VALUES (:date_vente,:idClient)");
        $q->bindValue(":date_vente", $obj->getDate_vente());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->execute();
    }

    public static function update(Table_vente $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE Table_vente SET idVente=:idVente,date_vente=:date_vente,idClient=:idClient WHERE idVente=:idVente");
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->bindValue(":date_vente", $obj->getDate_vente());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->execute();
    }
    public static function delete(Table_vente $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM Table_vente WHERE idVente=" . $obj->getIdVente());
    }
    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM Table_vente WHERE idVente =" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Table_vente($results);
        } else {
            return false;
        }
    }
    public static function getList()
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query("SELECT * FROM Table_vente");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_vente($donnees);
            }
        }
        return $liste;
    }

    public static function findListByDate($date)
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query('SELECT * FROM Table_vente WHERE date_vente="' . $date . '"');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_vente($donnees);
            }
        }
        return $liste;
    }

    public static function findByDate($date)
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query('SELECT * FROM Table_vente WHERE date_vente ="' . $date . '"');
        while ($results = $q->fetch(PDO::FETCH_ASSOC)) {

            if ($results != false) {
                $liste[] = new Table_vente($results);
            }
        }
        return $liste;
    }

    public static function findListByClient(table_client $client)
    {
        $db = DbConnect::getDb();
        $q = $db->query('SELECT * FROM Table_vente WHERE idClient =' . $client->getIdClient());
        $liste = [];
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_vente($donnees);
            }
        }
        return $liste;
    }

}
