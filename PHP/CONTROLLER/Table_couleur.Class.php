<?php

class Table_couleur 
{

	/*****************Attributs***************** */
	private $listeTypeInput = ["number","text", "hidden", "select"];
	private $listeInfos = ["Table_couleur","idCouleur","libCouleur","refCouleur"];
	private $listeLabel = ["Libellé des Couleurs", "Référence des Couleurs"];
	private $_idCouleur;
	private $_libCouleur;
	private $_refCouleur;

	/***************** Accesseurs ***************** */


	public function getIdCouleur()
	{
		return $this->_idCouleur;
	}

	public function setIdCouleur($idCouleur)
	{
		$this->_idCouleur=$idCouleur;
	}

	public function getLibCouleur()
	{
		return $this->_libCouleur;
	}

	public function setLibCouleur($libCouleur)
	{
		$this->_libCouleur=$libCouleur;
	}

	public function getRefCouleur()
	{
		return $this->_refCouleur;
	}

	public function setRefCouleur($refCouleur)
	{
		$this->_refCouleur=$refCouleur;
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
		return $this->getLibCouleur();
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
		return "IdCouleur : ".$this->getIdCouleur()."LibCouleur : ".$this->getLibCouleur()."RefCouleur : ".$this->getRefCouleur()."\n";
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