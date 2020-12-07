<?php

class Table_universManager 
{
	public static function add(Table_univers $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_univers (refUnivers,libUnivers) VALUES (:refUnivers,:libUnivers)");
		$q->bindValue(":refUnivers", $obj->getRefUnivers());
		$q->bindValue(":libUnivers", $obj->getLibUnivers());
		$q->execute();
	}

	public static function update(Table_univers $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_univers SET idUnivers=:idUnivers,refUnivers=:refUnivers,libUnivers=:libUnivers WHERE idUnivers=:idUnivers");
		$q->bindValue(":idUnivers", $obj->getIdUnivers());
		$q->bindValue(":refUnivers", $obj->getRefUnivers());
		$q->bindValue(":libUnivers", $obj->getLibUnivers());
		$q->execute();
	}
	public static function delete(Table_univers $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_univers WHERE idUnivers=" .$obj->getIdUnivers());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_univers WHERE idUnivers =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_univers($results);
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
		$q = $db->query("SELECT * FROM Table_univers");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_univers($donnees);
			}
		}
		return $liste;
	}
}