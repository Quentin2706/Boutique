<?php

class Table_userManager 
{
	public static function add(Table_user $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_user (pseudo,password,role) VALUES (:pseudo,:password,:role)");
		$q->bindValue(":pseudo", $obj->getPseudo());
		$q->bindValue(":password", $obj->getPassword());
		$q->bindValue(":role", $obj->getRole());
		$q->execute();
	}

	public static function update(Table_user $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_user SET iduser=:iduser,pseudo=:pseudo,password=:password,role=:role WHERE iduser=:iduser");
		$q->bindValue(":iduser", $obj->getIduser());
		$q->bindValue(":pseudo", $obj->getPseudo());
		$q->bindValue(":password", $obj->getPassword());
		$q->bindValue(":role", $obj->getRole());
		$q->execute();
	}
	public static function delete(Table_user $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_user WHERE iduser=" .$obj->getIduser());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_user WHERE iduser =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_user($results);
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
		$q = $db->query("SELECT * FROM Table_user");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_user($donnees);
			}
		}
		return $liste;
	}
}