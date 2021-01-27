<?php

class Table_categManager 
{
	public static function add(Table_categ $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_categ (refCateg,libCateg,idUnivers) VALUES (:refCateg,:libCateg,:idUnivers)");
		$q->bindValue(":refCateg", $obj->getRefCateg());
		$q->bindValue(":libCateg", $obj->getLibCateg());
		$q->bindValue(":idUnivers", $obj->getIdUnivers());
		$q->execute();
	}

	public static function update(Table_categ $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_categ SET idCateg=:idCateg,refCateg=:refCateg,libCateg=:libCateg,idUnivers=:idUnivers WHERE idCateg=:idCateg");
		$q->bindValue(":idCateg", $obj->getIdCateg());
		$q->bindValue(":refCateg", $obj->getRefCateg());
		$q->bindValue(":libCateg", $obj->getLibCateg());
		$q->bindValue(":idUnivers", $obj->getIdUnivers());
		$q->execute();
	}
	public static function delete(Table_categ $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_categ WHERE idCateg=" .$obj->getIdCateg());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_categ WHERE idCateg =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_categ($results);
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
		$q = $db->query("SELECT * FROM table_categ");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_categ($donnees);
			}
		}
		return $liste;
	}
	public static function findByReference($ref)
	{
 		$db=DbConnect::getDb();
		$q=$db->query("SELECT * FROM table_categ WHERE refCateg ='" .$ref. "'");
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_categ($results);
		}
		else
		{
			return false;
		}
	}
}