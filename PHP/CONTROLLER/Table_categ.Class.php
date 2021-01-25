<?php

class Table_categ 
{

	/*****************Attributs***************** */

	private static $listeAttributs=["Table_categ","idCateg","refCateg","libCateg","idUnivers"];
	private static $listeTypeInput = ["","","text","text","select"];
	private static $listeClass =["","","","","univers"];
	private static $listeLabel = ["","","Référence Categories", "Libelle Categories", "Référence Univers"];
	private static $nbColonne= 5;
	
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
	public static function getListeTypeInput()
	{
		return self::$listeTypeInput;
	}

	public function getListeInfos()
	{
		return $this->listeInfos;
	}

	public static function getListeLabel()
	{
		return self::$listeLabel;
	}

	public function getRefUnivers()
	{
		return ($this->getUnivers())->getRefUnivers();
	}
	public function getLibelle()
	{
		return $this->getLibCateg();
	}
	public static function getListeClass()
	{
		return self::$listeClass;
	}
	public static function getListeAttributs()
	{
		return self::$listeAttributs;
	}
	public static function getNbColonne()
		{
			return self::$nbColonne;
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