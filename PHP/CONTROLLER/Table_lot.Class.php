<?php

class Table_lot 
{

	/*****************Attributs***************** */
	private $listeTypeInput = ["number","text", "hidden", "select"];
	private $listeInfos = ["Table_lot","idLot","refLot"];
	private $listeLabel = ["Référence du Lot"];
	private $_idLot;
	private $_refLot;

	/***************** Accesseurs ***************** */


	public function getIdLot()
	{
		return $this->_idLot;
	}

	public function setIdLot($idLot)
	{
		$this->_idLot=$idLot;
	}

	public function getRefLot()
	{
		return $this->_refLot;
	}

	public function setRefLot($refLot)
	{
		$this->_refLot=$refLot;
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

	public function getLibLot()
	{
		return $this->_refLot;
	}
	public function getLibelle()
	{
		return $this->getRefLot();
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
		return "IdLot : ".$this->getIdLot()."Reflot : ".$this->getRefLot()."\n";
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