<?php

class Table_clientManager 
{
	public static function add(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_client (nomClient,adresseMail,adressePostale) VALUES (:nomClient,:adresseMail,:adressePostale)");
		$q->bindValue(":nomClient", $obj->getNomClient());
		$q->bindValue(":adresseMail", $obj->getAdresseMail());
		$q->bindValue(":adressePostale", $obj->getAdressePostale());
		$q->execute();
	}

	public static function update(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_client SET idClient=:idClient,nomClient=:nomClient,adresseMail=:adresseMail,adressePostale=:adressePostale WHERE idClient=:idClient");
		$q->bindValue(":idClient", $obj->getIdClient());
		$q->bindValue(":nomClient", $obj->getNomClient());
		$q->bindValue(":adresseMail", $obj->getAdresseMail());
		$q->bindValue(":adressePostale", $obj->getAdressePostale());
		$q->execute();
	}
	public static function delete(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_client WHERE idClient=" .$obj->getIdClient());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_client WHERE idClient =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_client($results);
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
		$q = $db->query("SELECT * FROM Table_client");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_client($donnees);
			}
		}
		return $liste;
	}
	public static function findByNom($nom)
	{
 		$db=DbConnect::getDb();
		$q=$db->query('SELECT * FROM Table_client WHERE nomClient ="'.$nom.'"');
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_client($results);
		}
		else
		{
			return false;
		}
	}
}