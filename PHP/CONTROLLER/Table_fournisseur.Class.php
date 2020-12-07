<?php

class Table_fournisseur 
{

	/*****************Attributs***************** */

	private $_idFournisseur;
	private $_refFournisseur;
	private $_libFournisseur;
	private $_adresseFournisseur;
	private $_telephoneFournisseur;

	/***************** Accesseurs ***************** */


	public function getIdFournisseur()
	{
		return $this->_idFournisseur;
	}

	public function setIdFournisseur($idFournisseur)
	{
		$this->_idFournisseur=$idFournisseur;
	}

	public function getRefFournisseur()
	{
		return $this->_refFournisseur;
	}

	public function setRefFournisseur($refFournisseur)
	{
		$this->_refFournisseur=$refFournisseur;
	}

	public function getLibFournisseur()
	{
		return $this->_libFournisseur;
	}

	public function setLibFournisseur($libFournisseur)
	{
		$this->_libFournisseur=$libFournisseur;
	}

	public function getAdresseFournisseur()
	{
		return $this->_adresseFournisseur;
	}

	public function setAdresseFournisseur($adresseFournisseur)
	{
		$this->_adresseFournisseur=$adresseFournisseur;
	}

	public function getTelephoneFournisseur()
	{
		return $this->_telephoneFournisseur;
	}

	public function setTelephoneFournisseur($telephoneFournisseur)
	{
		$this->_telephoneFournisseur=$telephoneFournisseur;
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
		return "IdFournisseur : ".$this->getIdFournisseur()."RefFournisseur : ".$this->getRefFournisseur()."LibFournisseur : ".$this->getLibFournisseur()."AdresseFournisseur : ".$this->getAdresseFournisseur()."TelephoneFournisseur : ".$this->getTelephoneFournisseur()."\n";
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