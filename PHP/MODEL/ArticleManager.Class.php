<?php
class ArticleManager
{
    public static function add(Article $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO table_article (refArticle,libArticle,idUnivers,idCateg,idFournisseur,idCouleur,idTaille,idIncrementale,idLot,quantiteStocke,prixAchat,prixVente,seuil) VALUES (:refArticle,:libArticle,:idUnivers,:idCateg,:idFournisseur,:idCouleur,:idTaille,:idIncrementale,:idLot,:quantiteStocke,:prixAchat,:prixVente,:seuil)");
        $q->bindValue(":refArticle", $obj->getRefArticle());
        $q->bindValue(":libArticle", $obj->getLibArticle());
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->bindValue(":idCateg", $obj->getIdCateg());
        $q->bindValue(":idFournisseur", $obj->getIdFournisseur());
        $q->bindValue(":idCouleur", $obj->getIdCouleur());
        $q->bindValue(":idTaille", $obj->getIdTaille());
        $q->bindValue(":idIncrementale", $obj->getIdIncrementale());
        $q->bindValue(":idLot", $obj->getIdLot());
        $q->bindValue(":quantiteStocke", $obj->getQuantiteStocke());
        $q->bindValue(":prixAchat", $obj->getPrixAchat());
        $q->bindValue(":prixVente", $obj->getPrixVente());
        $q->bindValue(":seuil", $obj->getSeuil());
        $q->execute();
    }

    public static function update(Article $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_article SET refArticle=:refArticle, libArticle=:libArticle, idUnivers=:idUnivers, idCateg=:idCateg, idFournisseur=:idFournisseur, idCouleur=:idCouleur, idTaille=:idTaille, idIncrementale=:idIncrementale, idLot=:idLot, quantiteStocke=:quantiteStocke, prixAchat=:prixAchat, prixVente=:prixVente, seuil=:seuil WHERE idArticle=:idArticle");
        $q->bindValue(":refArticle", $obj->getRefArticle());
        $q->bindValue(":libArticle", $obj->getLibArticle());
        $q->bindValue(":idUnivers", $obj->getIdUnivers());
        $q->bindValue(":idCateg", $obj->getIdCateg());
        $q->bindValue(":idFournisseur", $obj->getIdFournisseur());
        $q->bindValue(":idCouleur", $obj->getIdCouleur());
        $q->bindValue(":idTaille", $obj->getIdTaille());
        $q->bindValue(":idIncrementale", $obj->getIdIncrementale());
        $q->bindValue(":idLot", $obj->getIdLot());
        $q->bindValue(":quantiteStocke", $obj->getQuantiteStocke());
        $q->bindValue(":prixAchat", $obj->getPrixAchat());
        $q->bindValue(":prixVente", $obj->getPrixVente());
        $q->bindValue(":seuil", $obj->getSeuil());
        $q->bindValue(":idArticle", $obj->getIdArticle());
        $q->execute();
    }

    public static function delete(Article $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_article WHERE idArticle=" . $obj->getIdArticle());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM table_article WHERE idArticle=" . $id);
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return new Article($results);
        } else {
            return false;
        }
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $tab = [];
        $q = $db->query("SELECT * FROM table_article");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $tab[] = new Article($donnees);
            }
        }
        return $tab;
    }

}
