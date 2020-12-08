<?php

class Table_univers 
{

	/*****************Attributs***************** */
	private $listeTypeInput = ["number","text", "hidden", "select"];
	private $listeInfos = ["Table_univers","idUnivers","refUnivers","libUnivers"];
	private $listeLabel = ["Référence de l'univers", "Libellé de l'univers"];
	private $_idUnivers;
	private $_refUnivers;
	private $_libUnivers;

	/***************** Accesseurs ***************** */


	public function getIdUnivers()
	{
		return $this->_idUnivers;
	}

	public function setIdUnivers($idUnivers)
	{
		$this->_idUnivers=$idUnivers;
	}

	public function getRefUnivers()
	{
		return $this->_refUnivers;
	}

	public function setRefUnivers($refUnivers)
	{
		$this->_refUnivers=$refUnivers;
	}

	public function getLibUnivers()
	{
		return $this->_libUnivers;
	}

	public function setLibUnivers($libUnivers)
	{
		$this->_libUnivers=$libUnivers;
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
		return "IdUnivers : ".$this->getIdUnivers()."RefUnivers : ".$this->getRefUnivers()."LibUnivers : ".$this->getLibUnivers()."\n";
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