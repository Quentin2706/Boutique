<?php
class ClientManager
{
    public static function add(Client $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_client (nomClient,adresseMail,adressePostale) VALUES (:nomClient,:adresseMail,:adressePostale)");
        $q->bindValue(":nomClient", $obj->getNomClient());
        $q->bindValue(":adresseMail", $obj->getAdresseMail());
        $q->bindValue(":adressePostale", $obj->getAdressePostale());
        $q->execute();
    }

    public static function update(Client $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_client SET nomClient=:nomClient, adresseMail=:adresseMail, adressePostale=:adressePostale WHERE idClient=:idClient");
        $q->bindValue(":nomClient", $obj->getNomClient());
        $q->bindValue(":adresseMail", $obj->getAdresseMail());
        $q->bindValue(":adressePostale", $obj->getAdressePostale());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->execute();
    }

    public static function delete(Client $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_client WHERE idClient=" . $obj->getIdClient());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_client WHERE idClient=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Client($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_client");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Client($donnees);
            }
        }
        return $tab;
    }

}
