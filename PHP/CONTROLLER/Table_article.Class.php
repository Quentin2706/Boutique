<?php

class Table_article 
{

	/*****************Attributs***************** */

	private $_idArticle;
	private $_refArticle;
	private $_libArticle;
	private $_idUnivers;
	private $_idCateg;
	private $_idFournisseur;
	private $_idCouleur;
	private $_idTaille;
	private $_idIncrementale;
	private $_idLot;
	private $_quantiteStock;
	private $_prixAchat;
	private $_prixVente;
	private $_seuil;

	/***************** Accesseurs ***************** */


	public function getIdArticle()
	{
		return $this->_idArticle;
	}

	public function setIdArticle($idArticle)
	{
		$this->_idArticle=$idArticle;
	}

	public function getRefArticle()
	{
		return $this->_refArticle;
	}

	public function setRefArticle($refArticle)
	{
		$this->_refArticle=$refArticle;
	}

	public function getLibArticle()
	{
		return $this->_libArticle;
	}

	public function setLibArticle($libArticle)
	{
		$this->_libArticle=$libArticle;
	}

	public function getIdUnivers()
	{
		return $this->_idUnivers;
	}

	public function setIdUnivers($idUnivers)
	{
		$this->_idUnivers=$idUnivers;
	}

	public function getIdCateg()
	{
		return $this->_idCateg;
	}

	public function setIdCateg($idCateg)
	{
		$this->_idCateg=$idCateg;
	}

	public function getIdFournisseur()
	{
		return $this->_idFournisseur;
	}

	public function setIdFournisseur($idFournisseur)
	{
		$this->_idFournisseur=$idFournisseur;
	}

	public function getIdCouleur()
	{
		return $this->_idCouleur;
	}

	public function setIdCouleur($idCouleur)
	{
		$this->_idCouleur=$idCouleur;
	}

	public function getIdTaille()
	{
		return $this->_idTaille;
	}

	public function setIdTaille($idTaille)
	{
		$this->_idTaille=$idTaille;
	}

	public function getIdIncrementale()
	{
		return $this->_idIncrementale;
	}

	public function setIdIncrementale($idIncrementale)
	{
		$this->_idIncrementale=$idIncrementale;
	}

	public function getIdLot()
	{
		return $this->_idLot;
	}

	public function setIdLot($idLot)
	{
		$this->_idLot=$idLot;
	}

	public function getQuantiteStock()
	{
		return $this->_quantiteStock;
	}

	public function setQuantiteStock($quantiteStock)
	{
		$this->_quantiteStock=$quantiteStock;
	}

	public function getPrixAchat()
	{
		return $this->_prixAchat;
	}

	public function setPrixAchat($prixAchat)
	{
		$this->_prixAchat=$prixAchat;
	}

	public function getPrixVente()
	{
		return $this->_prixVente;
	}

	public function setPrixVente($prixVente)
	{
		$this->_prixVente=$prixVente;
	}

	public function getSeuil()
	{
		return $this->_seuil;
	}

	public function setSeuil($seuil)
	{
		$this->_seuil=$seuil;
	}

	/*****************Constructeur***************** */

	public function __construct(array $options = [])
	{
 		if (!empty($options)) // empty : renvoi vrai si le tableau est vide
		{
			$this->hydrate($options);
		}
	}
	public function hydrate($data)
	{
 		foreach ($data as $key => $value)
		{
 			$methode = "set".ucfirst($key); //ucfirst met la 1ere lettre en majuscule
			if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
			{
				$this->$methode($value);
			}
		}
	}

	/*****************Autres Méthodes***************** */

	/**
	* Transforme l'objet en chaine de caractères
	*
	* @return String
	*/
	public function toString()
	{
		return "IdArticle : ".$this->getIdArticle()."RefArticle : ".$this->getRefArticle()."LibArticle : ".$this->getLibArticle()."IdUnivers : ".$this->getIdUnivers()."IdCateg : ".$this->getIdCateg()."IdFournisseur : ".$this->getIdFournisseur()."IdCouleur : ".$this->getIdCouleur()."IdTaille : ".$this->getIdTaille()."IdIncrementale : ".$this->getIdIncrementale()."IdLot : ".$this->getIdLot()."QuantiteStock : ".$this->getQuantiteStock()."PrixAchat : ".$this->getPrixAchat()."PrixVente : ".$this->getPrixVente()."Seuil : ".$this->getSeuil()."\n";
	}


	
	/* Renvoit Vrai si lobjet en paramètre est égal 
	* à l'objet appelant
	*
	* @param [type] $obj
	* @return bool
	*/
	public function equalsTo($obj)
	{
		return;
	}


	/**
	* Compare l'objet à un autre
	* Renvoi 1 si le 1er est >
	*        0 si ils sont égaux
	*      - 1 si le 1er est <
	*
	* @param [type] $obj1
	* @param [type] $obj2
	* @return Integer
	*/
	public function compareTo($obj)
	{
		return;
	}
}