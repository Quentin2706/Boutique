<?php

class Table_detail_venteManager 
{
	public static function add(Table_detail_vente $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_detail_vente (idVente,quantite,idArticle,prixUnitaire,detailDivers) VALUES (:idVente,:quantite,:idArticle,:prixUnitaire,:detailDivers)");
		$q->bindValue(":idVente", $obj->getIdVente());
		$q->bindValue(":quantite", $obj->getQuantite());
		$q->bindValue(":idArticle", $obj->getIdArticle());
		$q->bindValue(":prixUnitaire", $obj->getPrixUnitaire());
		$q->bindValue(":detailDivers", $obj->getDetailDivers());
		$q->execute();
	}

	public static function update(Table_detail_vente $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_detail_vente SET idDetailVente=:idDetailVente,idVente=:idVente,quantite=:quantite,idArticle=:idArticle,prixUnitaire=:prixUnitaire,detailDivers=:detailDivers WHERE idDetailVente=:idDetailVente");
		$q->bindValue(":idDetailVente", $obj->getIdDetail_vente());
		$q->bindValue(":idVente", $obj->getIdVente());
		$q->bindValue(":quantite", $obj->getQuantite());
		$q->bindValue(":idArticle", $obj->getIdArticle());
		$q->bindValue(":prixUnitaire", $obj->getPrixUnitaire());
		$q->bindValue(":detailDivers", $obj->getDetailDivers());
		$q->execute();
	}
	public static function delete(Table_detail_vente $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_detail_vente WHERE idDetailVente=" .$obj->getIdDetail_vente());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT idDetailVente as idDetail_vente , idVente , quantite , idArticle , prixUnitaire, detailDivers  FROM table_detail_vente WHERE idDetailVente =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_detail_vente($results);
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
		$q = $db->query("SELECT * FROM table_detail_vente");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_detail_vente($donnees);
			}
		}
		return $liste;
	}

	public static function findByVente($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$liste=[];
		$q=$db->query("SELECT idDetailVente as idDetail_vente , idVente , quantite , idArticle , prixUnitaire, detailDivers FROM table_detail_vente WHERE idVente =".$id);
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_detail_vente($donnees);
			}
		}
		return $liste;
	}
}