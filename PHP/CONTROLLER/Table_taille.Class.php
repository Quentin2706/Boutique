<?php

class Table_taille 
{

	/*****************Attributs***************** */
	private $listeAttributs=["Table_taille","idTaille","libTaille","refTaille"];
	private $listeTypeInput = ["","","text", "text"];
	private $listeClass=["","","",""];
	private $listeLabel = ["","","Libellé de la taille", "Référence de la taille"];
	private $_idTaille;
	private $_libTaille;
	private $_refTaille;

	/***************** Accesseurs ***************** */


	public function getIdTaille()
	{
		return $this->_idTaille;
	}

	public function setIdTaille($idTaille)
	{
		$this->_idTaille=$idTaille;
	}

	public function getLibTaille()
	{
		return $this->_libTaille;
	}

	public function setLibTaille($libTaille)
	{
		$this->_libTaille=$libTaille;
	}

	public function getRefTaille()
	{
		return $this->_refTaille;
	}

	public function setRefTaille($refTaille)
	{
		$this->_refTaille=$refTaille;
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
	public function getLibelle()
	{
		return $this->getLibTaille();
	}
	public function getListeClass()
	{
		return $this->listeClass;
	}
	public function getListeAttributs()
	{
		return $this->listeAttributs;
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
		return "IdTaille : ".$this->getIdTaille()."LibTaille : ".$this->getLibTaille()."RefTaille : ".$this->getRefTaille()."\n";
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