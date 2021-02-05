<?php

class Table_promotionManager 
{
	public static function add(Table_promotion $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_promotion (idCateg,dateDebut,dateFin,taux) VALUES (:idCateg,:dateDebut,:dateFin,:taux)");
		$q->bindValue(":idCateg", $obj->getIdCateg());
		$q->bindValue(":dateDebut", $obj->getDateDebut());
		$q->bindValue(":dateFin", $obj->getDateFin());
		$q->bindValue(":taux", $obj->getTaux());
		$q->execute();
	}

	public static function update(Table_promotion $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_promotion SET idPromotion=:idPromotion,idCateg=:idCateg,dateDebut=:dateDebut,dateFin=:dateFin,taux=:taux WHERE idPromotion=:idPromotion");
		$q->bindValue(":idPromotion", $obj->getIdPromotion());
		$q->bindValue(":idCateg", $obj->getIdCateg());
		$q->bindValue(":dateDebut", $obj->getDateDebut());
		$q->bindValue(":dateFin", $obj->getDateFin());
		$q->bindValue(":taux", $obj->getTaux());
		$q->execute();
	}
	public static function delete(Table_promotion $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_promotion WHERE idPromotion=" .$obj->getIdPromotion());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_promotion WHERE idPromotion =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_promotion($results);
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
		$q = $db->query("SELECT * FROM table_promotion");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_promotion($donnees);
			}
		}
		return $liste;
	}

	public static function getListByCateg($id)
	{
		$db=DbConnect::getDb();
		$id=(int)$id; 
		$liste = [];
		$q = $db->query("SELECT * FROM table_promotion WHERE idCateg=".$id);
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_promotion($donnees);
			}
		}
		return $liste;
	}
}