<?php

class Table_tailleManager 
{
	public static function add(Table_taille $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_taille (libTaille,refTaille) VALUES (:libTaille,:refTaille)");
		$q->bindValue(":libTaille", $obj->getLibTaille());
		$q->bindValue(":refTaille", $obj->getRefTaille());
		$q->execute();
	}

	public static function update(Table_taille $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_taille SET idTaille=:idTaille,libTaille=:libTaille,refTaille=:refTaille WHERE idTaille=:idTaille");
		$q->bindValue(":idTaille", $obj->getIdTaille());
		$q->bindValue(":libTaille", $obj->getLibTaille());
		$q->bindValue(":refTaille", $obj->getRefTaille());
		$q->execute();
	}
	public static function delete(Table_taille $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_taille WHERE idTaille=" .$obj->getIdTaille());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_taille WHERE idTaille =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_taille($results);
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
		$q = $db->query("SELECT * FROM table_taille");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_taille($donnees);
			}
		}
		return $liste;
	}
}