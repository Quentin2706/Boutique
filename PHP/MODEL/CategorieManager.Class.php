<?php
class CategorieManager
{
    public static function add(Categorie $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_categ (refCateg,libCateg,idUnivers) VALUES (:refCateg,:libCateg,:idUnivers)");
        $q->bindValue(":refCateg", $obj->getRefCateg());
        $q->bindValue(":libCateg", $obj->getLibCateg());
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->execute();
    }

    public static function update(Categorie $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_categ SET refCateg=:refCateg, libCateg=:libCateg, idUnivers=:idUnivers WHERE idCateg=:idCateg");
        $q->bindValue(":refCateg", $obj->getRefCateg());
        $q->bindValue(":libCateg", $obj->getLibCateg());
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->bindValue(":idCateg", $obj->getIdCateg());
        $q->execute();
    }

    public static function delete(Categorie $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_categ WHERE idCateg=" . $obj->getIdCateg());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_categ WHERE idCateg=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Categorie($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_categ");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Categorie($donnees);
            }
        }
        return $tab;
    }

}
