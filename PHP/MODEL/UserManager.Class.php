<?php
// Il s'agit de la classe de management de la classe User.
// Ici seul 2 �thodes sont impl�ment�es
class UserManager {
	
	static public function add(User $perso) {
		$db = DbConnect::getDb (); // Instance de PDO.
		                          // Préparation de la requête d'insertion.
		$q = $db->prepare ( 'INSERT INTO table_user (Pseudo, Password, Role) VALUES(:pseudo, :password, :role)' );
		
		// Assignation des valeurs .
		$q->bindValue ( ':pseudo', $perso->getPseudo () );
		$q->bindValue ( ':password', $perso->getPassword () );
		$q->bindValue ( ':role', $perso->getRole () );
		
		// Exécution de la requête.
		$q->execute ();
		$q->CloseCursor ();
	}

	public static function update(User $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE table_user SET pseudo=:pseudo, password=:password, role=:role WHERE idUser=:idUser");
        $q->bindValue ( ':pseudo', $obj->getPseudo () );
		$q->bindValue ( ':password', $obj->getPassword () );
		$q->bindValue ( ':role', $obj->getRole () );
		$q->bindValue ( ':idUser', $obj->getIdUser () );
        $q->execute();
	}
	
	public static function delete(User $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM table_user WHERE idUser=" . $obj->getIdUser());
	}
	
	static public function findById($id) {
			$db = DbConnect::getDb (); // Instance de PDO.
			// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personne
			$q = $db->prepare ( 'SELECT Pseudo Password IdUser Role FROM table_user WHERE idUser = :id' );
			
			// Assignation des valeurs .
			$q->bindValue ( ':id', $id );
			$q->execute ();
			$donnees = $q->fetch ( PDO::FETCH_ASSOC );
			$q->CloseCursor ();
			if ($donnees == false) { // Si l'utilisateur n'existe pas, on renvoi un objet vide
				return new User ();
			} else {
				return new User ( $donnees );
			}
		}
	
	public static function getList()
		{
			$db = DbConnect::getDb();
			$tab = [];
			$q = $db->query("SELECT * FROM table_user");
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				if ($donnees != false) {
					$tab[] = new User($donnees);
				}
			}
			return $tab;
		}	

	static public function getByPseudo($pseudo) {
		$db = DbConnect::getDb (); // Instance de PDO.
		// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personne
		$q = $db->prepare ('SELECT Pseudo Password IdUser Role FROM table_user WHERE Pseudo = :pseudo' );
		
		// Assignation des valeurs .
		$q->bindValue ( ':pseudo', $pseudo );
		$q->execute ();
		$donnees = $q->fetch ( PDO::FETCH_ASSOC );
		$q->CloseCursor ();
		if ($donnees == false) { // Si l'utilisateur n'existe pas, on renvoi un objet vide
			return new User ();
		} else {
			return new User ( $donnees );
		}
	}
	
}