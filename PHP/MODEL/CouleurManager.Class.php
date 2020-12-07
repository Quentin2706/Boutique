<?php
class CouleurManager
{
    public static function add(Couleur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_couleur (libCouleur,refCouleur) VALUES (:libCouleur,:refCouleur)");
        $q->bindValue(":libCouleur", $obj->getLibCouleur());
        $q->bindValue(":refCouleur", $obj->getRefCouleur());
        $q->execute();
    }

    public static function update(Couleur $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_couleur SET libCouleur=:libCouleur, refCouleur=:refCouleur WHERE idCouleur=:idCouleur");
        $q->bindValue(":libCouleur", $obj->getLibCouleur());
        $q->bindValue(":refCouleur", $obj->getRefCouleur());
        $q->bindValue(":idCouleur", $obj->getIdCouleur());
        $q->execute();
    }

    public static function delete(Couleur $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_couleur WHERE idCouleur=" . $obj->getIdCouleur());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_couleur WHERE idCouleur=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Couleur($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_couleur");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Couleur($donnees);
            }
        }
        return $tab;
    }

}
