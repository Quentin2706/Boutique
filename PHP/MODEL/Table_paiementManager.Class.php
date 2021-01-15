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

	public static function sommePaiement($idVente)
	{
		$db=DbConnect::getDb();
		$id=(int) $idVente;
		$q=$db->query("SELECT montant FROM table_paiement WHERE idVente =".$idVente);
		$sommePaiement=0;
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$sommePaiement+=$donnees["montant"];
			}
		}
		return $sommePaiement;
	}

	public static function montantTotal($idVente)
	{
		$db=DbConnect::getDb();
		$q=$db->query("SELECT prixUnitaire, quantite FROM table_detail_vente WHERE idVente=".$idVente);
		$montantTotal=0;
		while($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			if($donnees != false)
			{
				$quantite=$donnees["quantite"];
				$prixUnitaire=$donnees["prixUnitaire"];
				$montantTotal+=$quantite*$prixUnitaire;
			}
		}
		return $montantTotal;
	}

	public static function montantTotalRemise($idVente, $taux)
	{
		$db=DbConnect::getDb();
		// $q=$db->query("SELECT taux FROM table_promotion WHERE ")
		$montantTotal=Table_paiementManager::montantTotal($idVente);
		// $montantTotalRemise=$montantTotal
		return ($montantTotal*($taux/100));
	}

	public static function resteDu($idVente)
	{
		$db=DbConnect::getDb();
		$montantTotal=Table_paiementManager::montantTotal($idVente);
		$sommePaye=Table_paiementManager::sommePaiement($idVente);
		return ($montantTotal-$sommePaye);
	}

	public static function findByVente($id)
	{
		$db=DbConnect::getDb();
	    $liste = [];
	    $q = $db->query("SELECT * FROM Table_paiement WHERE idVente=".$id);
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