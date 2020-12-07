<?php
class PaiementManager
{
    public static function add(Paiement $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_paiement (idVente,idmodePaiement,montant,idClient,banque) VALUES (:idVente,:idmodePaiement,:montant,:idClient,:banque)");
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->bindValue(":idmodePaiement", $obj->getIdmodePaiement());
        $q->bindValue(":montant", $obj->getMontant());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->bindValue(":banque", $obj->getBanque());
        $q->execute();
    }

    public static function update(Paiement $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_paiement SET idVente=:idVente, idmodePaiement=:idmodePaiement, montant=:montant, idClient=:idClient, banque=:banque WHERE idpaiement=:idpaiement");
        $q->bindValue(":idVente", $obj->getIdVente());
        $q->bindValue(":idmodePaiement", $obj->getIdmodePaiement());
        $q->bindValue(":montant", $obj->getMontant());
        $q->bindValue(":idClient", $obj->getIdClient());
        $q->bindValue(":banque", $obj->getBanque());
        $q->bindValue(":idpaiement", $obj->getIdpaiement());
        $q->execute();
    }

    public static function delete(Paiement $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_paiement WHERE idpaiement=" . $obj->getIdpaiement());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_paiement WHERE idpaiement=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Paiement($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_paiement");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Paiement($donnees);
            }
        }
        return $tab;
    }

}
