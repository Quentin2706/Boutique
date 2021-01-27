<?php

class Table_incrementaleManager 
{
	public static function add(Table_incrementale $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_incrementale (refIncrementale) VALUES (:refIncrementale)");
		$q->bindValue(":refIncrementale", $obj->getRefIncrementale());
		$q->execute();
	}

	public static function update(Table_incrementale $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_incrementale SET idIncrementale=:idIncrementale,refIncrementale=:refIncrementale WHERE idIncrementale=:idIncrementale");
		$q->bindValue(":idIncrementale", $obj->getIdIncrementale());
		$q->bindValue(":refIncrementale", $obj->getRefIncrementale());
		$q->execute();
	}
	public static function delete(Table_incrementale $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_incrementale WHERE idIncrementale=" .$obj->getIdIncrementale());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_incrementale WHERE idIncrementale =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_incrementale($results);
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
		$q = $db->query("SELECT * FROM table_incrementale");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_incrementale($donnees);
			}
		}
		return $liste;
	}
}