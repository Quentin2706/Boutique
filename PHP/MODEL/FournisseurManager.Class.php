<?php
class FournisseurManager
{
    public static function add(Fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_fournisseur (refFournisseur,libFournisseur,adresseFournisseur,telephoneFournisseur) VALUES (:refFournisseur,:libFournisseur,:adresseFournisseur,:telephoneFournisseur)");
        $q->bindValue(":refFournisseur", $obj->getRefFournisseur());
        $q->bindValue(":libFournisseur", $obj->getLibFournisseur());
        $q->bindValue(":adresseFournisseur", $obj->getAdresseFournisseur());
        $q->bindValue(":telephoneFournisseur", $obj->getTelephoneFournisseur());
        $q->execute();
    }

    public static function update(Fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_fournisseur SET refFournisseur=:refFournisseur, libFournisseur=:libFournisseur, adresseFournisseur=:adresseFournisseur, telephoneFournisseur=:telephoneFournisseur WHERE idFournisseur=:idFournisseur");
        $q->bindValue(":refFournisseur", $obj->getRefFournisseur());
        $q->bindValue(":libFournisseur", $obj->getLibFournisseur());
        $q->bindValue(":adresseFournisseur", $obj->getAdresseFournisseur());
        $q->bindValue(":telephoneFournisseur", $obj->getTelephoneFournisseur());
        $q->bindValue(":idFournisseur", $obj->getIdFournisseur());
        $q->execute();
    }

    public static function delete(Fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_fournisseur WHERE idFournisseur=" . $obj->getIdFournisseur());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_fournisseur WHERE idFournisseur=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Fournisseur($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_fournisseur");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Fournisseur($donnees);
            }
        }
        return $tab;
    }

}
