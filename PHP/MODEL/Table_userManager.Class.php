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

	static public function findByPseudo($pseudo) {
		$db = DbConnect::getDb (); // Instance de PDO.
		// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personne
		if (!in_array(";",str_split( $pseudo))) // s'il n'y a pas de ; , je lance la requete
        {
			$q = $db->prepare ('SELECT Pseudo, Password, IdUser, Role FROM table_user WHERE Pseudo = :pseudo' );
			
			// Assignation des valeurs .
			$q->bindValue ( ':pseudo', $pseudo );
			$q->execute ();
			$donnees = $q->fetch ( PDO::FETCH_ASSOC );
			$q->CloseCursor ();
			if ($donnees == false) { // Si l'utilisateur n'existe pas, on renvoi un objet vide
				return false;
			} else {
				return new Table_user ( $donnees );
			}
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