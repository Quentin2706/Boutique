<?php

class Table_fournisseurManager
{
    public static function add(Table_fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO Table_fournisseur (refFournisseur,libFournisseur,adresseFournisseur,telephoneFournisseur) VALUES (:refFournisseur,:libFournisseur,:adresseFournisseur,:telephoneFournisseur)");
        $q->bindValue(":refFournisseur", $obj->getRefFournisseur());
        $q->bindValue(":libFournisseur", $obj->getLibFournisseur());
        $q->bindValue(":adresseFournisseur", $obj->getAdresseFournisseur());
        $q->bindValue(":telephoneFournisseur", $obj->getTelephoneFournisseur());
        $q->execute();
    }

    public static function update(Table_fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE Table_fournisseur SET idFournisseur=:idFournisseur,refFournisseur=:refFournisseur,libFournisseur=:libFournisseur,adresseFournisseur=:adresseFournisseur,telephoneFournisseur=:telephoneFournisseur WHERE idFournisseur=:idFournisseur");
        $q->bindValue(":idFournisseur", $obj->getIdFournisseur());
        $q->bindValue(":refFournisseur", $obj->getRefFournisseur());
        $q->bindValue(":libFournisseur", $obj->getLibFournisseur());
        $q->bindValue(":adresseFournisseur", $obj->getAdresseFournisseur());
        $q->bindValue(":telephoneFournisseur", $obj->getTelephoneFournisseur());
        $q->execute();
    }
    public static function delete(Table_fournisseur $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM Table_fournisseur WHERE idFournisseur=" . $obj->getIdFournisseur());
    }
    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM Table_fournisseur WHERE idFournisseur =" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Table_fournisseur($results);
        } else {
            return false;
        }
    }
    public static function getList()
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query("SELECT * FROM Table_fournisseur");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_fournisseur($donnees);
            }
        }
        return $liste;
    }
    public static function findByReference($ref)
    {
        $db = DbConnect::getDb();
        if (!in_array(";", str_split($ref))) // s'il n'y a pas de ; , je lance la requete
        {
            $q = $db->query("SELECT * FROM Table_fournisseur WHERE refFournisseur ='" . $ref . "'");
            $results = $q->fetch(PDO::FETCH_ASSOC);
            if ($results != false) {
                return new Table_fournisseur($results);
            } else {
                return false;
            }
        } else {
			return false;
		}
    }
    public static function findByLibelle($libelle)
    {
        $db = DbConnect::getDb();
        if (!in_array(";", str_split($libelle))) // s'il n'y a pas de ; , je lance la requete
        {
            $q = $db->query("SELECT * FROM Table_fournisseur WHERE libFournisseur ='" . $libelle . "'");
            $results = $q->fetch(PDO::FETCH_ASSOC);
            if ($results != false) {
                return new Table_fournisseur($results);
            } else {
                return false;
            }
        } else{
			return false;
		}
    }
}
