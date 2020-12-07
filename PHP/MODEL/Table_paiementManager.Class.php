<?php

class Table_paiementManager 
{
	public static function add(Table_paiement $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("INSERT INTO Table_paiement (idVente,idmodePaiement,montant,idClient,banque) VALUES (:idVente,:idmodePaiement,:montant,:idClient,:banque)");
		$q->bindValue(":idVente", $obj->getIdVente());
		$q->bindValue(":idmodePaiement", $obj->getIdmodePaiement());
		$q->bindValue(":montant", $obj->getMontant());
		$q->bindValue(":idClient", $obj->getIdClient());
		$q->bindValue(":banque", $obj->getBanque());
		$q->execute();
	}

	public static function update(Table_paiement $obj)
	{
 		$db=DbConnect::getDb();
		$q=$db->prepare("UPDATE Table_paiement SET idpaiement=:idpaiement,idVente=:idVente,idmodePaiement=:idmodePaiement,montant=:montant,idClient=:idClient,banque=:banque WHERE idpaiement=:idpaiement");
		$q->bindValue(":idpaiement", $obj->getIdpaiement());
		$q->bindValue(":idVente", $obj->getIdVente());
		$q->bindValue(":idmodePaiement", $obj->getIdmodePaiement());
		$q->bindValue(":montant", $obj->getMontant());
		$q->bindValue(":idClient", $obj->getIdClient());
		$q->bindValue(":banque", $obj->getBanque());
		$q->execute();
	}
	public static function delete(Table_paiement $obj)
	{
 		$db=DbConnect::getDb();
		$db->exec("DELETE FROM Table_paiement WHERE idpaiement=" .$obj->getIdpaiement());
	}
	public static function findById($id)
	{
 		$db=DbConnect::getDb();
		$id = (int) $id;
		$q=$db->query("SELECT * FROM Table_paiement WHERE idpaiement =".$id);
		$results = $q->fetch(PDO::FETCH_ASSOC);
		if($results != false)
		{
			return new Table_paiement($results);
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
		$q = $db->query("SELECT * FROM Table_paiement");
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$liste[] = new Table_paiement($donnees);
			}
		}
		return $liste;
	}
}