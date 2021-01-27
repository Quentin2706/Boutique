<?php

class Table_lotManager 
{
	public static function add(Table_lot $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_lot (reflot) VALUES (:reflot)");
		$q->bindValue(":reflot", $obj->getReflot());
		$q->execute();
	}

	public static function update(Table_lot $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_lot SET idLot=:idLot,reflot=:reflot WHERE idLot=:idLot");
		$q->bindValue(":idLot", $obj->getIdLot());
		$q->bindValue(":reflot", $obj->getReflot());
		$q->execute();
	}
	public static function delete(Table_lot $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_lot WHERE idLot=" .$obj->getIdLot());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_lot WHERE idLot =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_lot($results);
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
		$q = $db->query("SELECT * FROM table_lot");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_lot($donnees);
			}
		}
		return $liste;
	}
}