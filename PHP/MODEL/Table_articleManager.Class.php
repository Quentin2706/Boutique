<?php

class Table_articleManager 
{
	public static function add(Table_article $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_article (refArticle,libArticle,idUnivers,idCateg,idFournisseur,idCouleur,idTaille,idIncrementale,idLot,quantiteStock,prixAchat,prixVente,seuil) VALUES (:refArticle,:libArticle,:idUnivers,:idCateg,:idFournisseur,:idCouleur,:idTaille,:idIncrementale,:idLot,:quantiteStock,:prixAchat,:prixVente,:seuil)");
		$q->bindValue(":refArticle", $obj->getRefArticle());
		$q->bindValue(":libArticle", $obj->getLibArticle());
		$q->bindValue(":idUnivers", $obj->getIdUnivers());
		$q->bindValue(":idCateg", $obj->getIdCateg());
		$q->bindValue(":idFournisseur", $obj->getIdFournisseur());
		$q->bindValue(":idCouleur", $obj->getIdCouleur());
		$q->bindValue(":idTaille", $obj->getIdTaille());
		$q->bindValue(":idIncrementale", $obj->getIdIncrementale());
		$q->bindValue(":idLot", $obj->getIdLot());
		$q->bindValue(":quantiteStock", $obj->getQuantiteStock());
		$q->bindValue(":prixAchat", $obj->getPrixAchat());
		$q->bindValue(":prixVente", $obj->getPrixVente());
		$q->bindValue(":seuil", $obj->getSeuil());
		$q->execute();
	}

	public static function update(Table_article $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_article SET idArticle=:idArticle,refArticle=:refArticle,libArticle=:libArticle,idUnivers=:idUnivers,idCateg=:idCateg,idFournisseur=:idFournisseur,idCouleur=:idCouleur,idTaille=:idTaille,idIncrementale=:idIncrementale,idLot=:idLot,quantiteStock=:quantiteStock,prixAchat=:prixAchat,prixVente=:prixVente,seuil=:seuil WHERE idArticle=:idArticle");
		$q->bindValue(":idArticle", $obj->getIdArticle());
		$q->bindValue(":refArticle", $obj->getRefArticle());
		$q->bindValue(":libArticle", $obj->getLibArticle());
		$q->bindValue(":idUnivers", $obj->getIdUnivers());
		$q->bindValue(":idCateg", $obj->getIdCateg());
		$q->bindValue(":idFournisseur", $obj->getIdFournisseur());
		$q->bindValue(":idCouleur", $obj->getIdCouleur());
		$q->bindValue(":idTaille", $obj->getIdTaille());
		$q->bindValue(":idIncrementale", $obj->getIdIncrementale());
		$q->bindValue(":idLot", $obj->getIdLot());
		$q->bindValue(":quantiteStock", $obj->getQuantiteStock());
		$q->bindValue(":prixAchat", $obj->getPrixAchat());
		$q->bindValue(":prixVente", $obj->getPrixVente());
		$q->bindValue(":seuil", $obj->getSeuil());
		$q->execute();
	}
	public static function delete(Table_article $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_article WHERE idArticle=" .$obj->getIdArticle());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_article WHERE idArticle =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_article($results);
		}
		else
		{
			return false;
		}
	}
	public static function getList()
	{
 		$db=DbConnect::getDb();
		$liste = [];
		$q = $db->query("SELECT * FROM Table_article");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_article($donnees);
			}
		}
		return $liste;
	}
	public static function rechercheMulti($tab)
	{
		$db=DbConnect::getDb();
		$compteur=0;
		$requete="SELECT * FROM table_article WHERE ";
		foreach ($tab as $nomColonne=>$elt)
		{
			if ($compteur==count($tab))
			{
				$requete.=$nomColonne." = ".$elt;
			} else {
			$requete.=$nomColonne." = ".$elt." ,";
			}
			$compteur+=1;
		}
		$q = $qb -> query($requete);
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_article($donnees);
			}
		}
		return $liste;
	}

	public static function calculPrixPromotion(Table_article $article)
	{
		$db=DbConnect::getDb();
		$auj=new Datetime("now");
		$q=$db->query("SELECT taux FROM table_promotion WHERE idCateg=".$article->getIdCateg()." AND dateDebut < ".$auj." AND dateFin > ".$auj);
		if($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			return $article->getPrixArticle()*($donnees["taux"]/100);
		} else {
			return $article->getPrixArticle();
		}
		
	}

}