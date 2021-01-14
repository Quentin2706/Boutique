<?php

class Table_modepaiement 
{

	/*****************Attributs***************** */
	private static $listeAttributs=["Table_modepaiement","idModePaiement","libModePaiement"];
	private static $listeTypeInput = ["","", "text"];
	private static $listeClass=["","",""];
	private static $listeLabel = ["","","Mode de paiement"];
	private static $nbColonne= 3;
	
	private $_idModePaiement;
	private $_libModePaiement;

	/***************** Accesseurs ***************** */


	public function getIdModePaiement()
	{
		return $this->_idModePaiement;
	}

	public function setIdModePaiement($idModePaiement)
	{
		$this->_idModePaiement=$idModePaiement;
	}

	public function getLibModePaiement()
	{
		return $this->_libModePaiement;
	}

	public function setLibModePaiement($libModePaiement)
	{
		$this->_libModePaiement=$libModePaiement;
	}
	public static function getListeTypeInput()
	{
		return self::$listeTypeInput;
	}

	public static function getListeLabel()
	{
		return self::$listeLabel;
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
		public function getLibelle()
		{
			return $this->getLibModePaiement();
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
		return "IdModePaiement : ".$this->getIdModePaiement()."LibModePaiement : ".$this->getLibModePaiement()."\n";
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