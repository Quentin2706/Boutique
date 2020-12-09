<?php

class Table_categ 
{

	/*****************Attributs***************** */

	
	private $listeInfos = ["Table_categ","idCateg","refCateg","libCateg","refUnivers"];
	private $listeTypeInput = ["text","text","select"];
	private $listeLabel = ["Référence Categories", "Libelle Categories", "Référence Univers"];
	private $_idCateg;
	private $_refCateg;
	private $_libCateg;
	private $_idUnivers;
	private $_univers;

	/***************** Accesseurs ***************** */


	public function getIdCateg()
	{
		return $this->_idCateg;
	}

	public function setIdCateg($idCateg)
	{
		$this->_idCateg=$idCateg;
	}

	public function getRefCateg()
	{
		return $this->_refCateg;
	}

	public function setRefCateg($refCateg)
	{
		$this->_refCateg=$refCateg;
	}

	public function getLibCateg()
	{
		return $this->_libCateg;
	}

	public function setLibCateg($libCateg)
	{
		$this->_libCateg=$libCateg;
	}

	public function getIdUnivers()
	{
		return $this->_idUnivers;
	}

	public function setIdUnivers(int $idUnivers)
	{
		$this->_idUnivers=$idUnivers;
		$this->setUnivers(Table_universManager::findById($idUnivers));
	}
	
	public function getUnivers()
	{
		return $this->_univers;
	}

	public function setUnivers($univers)
	{
		$this->_univers = $univers;
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

	public function getRefUnivers()
	{
		return ($this->getUnivers())->getRefUnivers();
	}
	public function getLibelle()
	{
		return $this->getLibCateg();
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
		return "IdCateg : ".$this->getIdCateg()."RefCateg : ".$this->getRefCateg()."LibCateg : ".$this->getLibCateg()."IdUnivers : ".$this->getIdUnivers()."\n";
	}

}