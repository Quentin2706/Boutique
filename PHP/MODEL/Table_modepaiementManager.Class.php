<?php

class Table_modepaiementManager 
{
	public static function add(Table_modepaiement $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_modepaiement (idModePaiement, libModePaiement) VALUES (:idModePaiement,:libModePaiement)");
		$q->bindValue(":libModePaiement", $obj->getLibModePaiement());
		$q->bindValue(":idModePaiement", $obj->getIdModePaiement());
		$q->execute();
	}

	public static function update(Table_modepaiement $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_modepaiement SET idModePaiement=:idModePaiement,libModePaiement=:libModePaiement WHERE idModePaiement=:idModePaiement");
		$q->bindValue(":idModePaiement", $obj->getIdModePaiement());
		$q->bindValue(":libModePaiement", $obj->getLibModePaiement());
		$q->execute();
	}
	public static function delete(Table_modepaiement $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec('DELETE FROM Table_modepaiement WHERE idModePaiement="' .$obj->getIdModePaiement().'"');
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$q=$db->query('SELECT * FROM Table_modepaiement WHERE idModePaiement ="'.$id.'"');
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_modepaiement($results);
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
		$q = $db->query("SELECT * FROM Table_modepaiement");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_modepaiement($donnees);
			}
		}
		return $liste;
	}

	public static function findByCodeMode($codeMode)
	{
 		$db=DbConnect::getDb();
		$q=$db->query('SELECT * FROM Table_modepaiement WHERE libModePaiement ="'.$codeMode.'"');
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_modepaiement($results);
		}
		else
		{
			return false;
		}
	}
}