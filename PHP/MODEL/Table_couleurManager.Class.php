<?php

class Table_couleurManager 
{
	public static function add(Table_couleur $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_couleur (libCouleur,refCouleur) VALUES (:libCouleur,:refCouleur)");
		$q->bindValue(":libCouleur", $obj->getLibCouleur());
		$q->bindValue(":refCouleur", $obj->getRefCouleur());
		$q->execute();
	}

	public static function update(Table_couleur $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_couleur SET idCouleur=:idCouleur,libCouleur=:libCouleur,refCouleur=:refCouleur WHERE idCouleur=:idCouleur");
		$q->bindValue(":idCouleur", $obj->getIdCouleur());
		$q->bindValue(":libCouleur", $obj->getLibCouleur());
		$q->bindValue(":refCouleur", $obj->getRefCouleur());
		$q->execute();
	}
	public static function delete(Table_couleur $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_couleur WHERE idCouleur=" .$obj->getIdCouleur());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_couleur WHERE idCouleur =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_couleur($results);
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
		$q = $db->query("SELECT * FROM Table_couleur");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_couleur($donnees);
			}
		}
		return $liste;
	}
	public static function findByReference($ref)
	{
 		$db=DbConnect::getDb();
		$ref = (int) $ref;
		$q=$db->query("SELECT * FROM Table_couleur WHERE referenceCouleur =".$ref);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_couleur($results);
		}
		else
		{
			return false;
		}
	}
}