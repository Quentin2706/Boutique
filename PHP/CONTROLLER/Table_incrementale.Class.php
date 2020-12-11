<?php

class Table_incrementale 
{

	/*****************Attributs***************** */
	private $listeAttributs=["Table_incrementale","idIncrementale","refIncrementale"];
	private $listeTypeInput = ["","", "text"];
	private $listeClass=["","",""];
	private $listeLabel = ["","","Référence Incrémentale"];

	private $_idIncrementale;
	private $_refIncrementale;

	/***************** Accesseurs ***************** */


	public function getIdIncrementale()
	{
		return $this->_idIncrementale;
	}

	public function setIdIncrementale($idIncrementale)
	{
		$this->_idIncrementale=$idIncrementale;
	}

	public function getRefIncrementale()
	{
		return $this->_refIncrementale;
	}

	public function setRefIncrementale($refIncrementale)
	{
		$this->_refIncrementale=$refIncrementale;
	}
	public function getListeTypeInput()
	{
		return $this->listeTypeInput;
	}

	public function getListeInfos()
	{
		return $this->listeInfos;
	}

	public function getListeLabel()
	{
		return $this->listeLabel;
	}

	public function getLibIncrementale()
	{
		return $this->_refIncrementale;
	}
	public function getLibelle()
	{
		return $this->getLibIncrementale();
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
	public function getListeClass()
	{
		return $this->listeClass;
	}
	public function getListeAttributs()
	{
		return $this->listeAttributs;
	}

	/*****************Autres Méthodes***************** */

	/**
	* Transforme l'objet en chaine de caractères
	*
	* @return String
	*/
	public function toString()
	{
		return "IdIncrementale : ".$this->getIdIncrementale()."RefIncrementale : ".$this->getRefIncrementale()."\n";
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