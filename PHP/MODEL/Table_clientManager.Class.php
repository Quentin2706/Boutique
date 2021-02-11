<?php

class Table_clientManager
{
	public static function add(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO table_client (nomClient,adresseMail,adressePostale) VALUES (:nomClient,:adresseMail,:adressePostale)");
		$q->bindValue(":nomClient", $obj->getNomClient());
		$q->bindValue(":adresseMail", $obj->getAdresseMail());
		$q->bindValue(":adressePostale", $obj->getAdressePostale());
		$q->execute();
	}

	public static function update(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE table_client SET idClient=:idClient,nomClient=:nomClient,adresseMail=:adresseMail,adressePostale=:adressePostale WHERE idClient=:idClient");
		$q->bindValue(":idClient", $obj->getIdClient());
		$q->bindValue(":nomClient", $obj->getNomClient());
		$q->bindValue(":adresseMail", $obj->getAdresseMail());
		$q->bindValue(":adressePostale", $obj->getAdressePostale());
		$q->execute();
	}
	public static function delete(Table_client $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM table_client WHERE idClient=" .$obj->getIdClient());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM table_client WHERE idClient =".$id);
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
		$q = $db->query("SELECT * FROM table_client");
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
		$q=$db->query('SELECT * FROM table_client WHERE nomClient ="'.$nom.'"');
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

	public static function findByIdAPI($id)
	{
		 $db=DbConnect::getDb();
		 $id=(int)$id;
		$q=$db->query('SELECT * FROM table_client WHERE idClient ='.$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return $results;
		}
		else
		{
			return false;
		}
	}
	public static function getListSort()
	{
		$db=DbConnect::getDb();
		$liste = [];
		$q = $db->query("SELECT * FROM table_client ORDER BY nomClient");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_client($donnees);
			}
		}
		return $liste;
	}

	public static function findLastClient()
	{
		$db = DbConnect::getDb();
        $q = $db->query("SELECT `idClient` FROM `table_client` WHERE `idClient` = (SELECT MAX(`idClient`) FROM `table_client`)");
        $results = $q->fetch(PDO::FETCH_ASSOC);
        if ($results != false) {
            return $results["idClient"];
        } else {
            return false;
        }
	}


}