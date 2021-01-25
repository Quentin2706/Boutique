<?php

class Table_taille 
{

	/*****************Attributs***************** */
	private static $listeAttributs=["Table_taille","idTaille","libTaille","refTaille"];
	private static $listeTypeInput = ["","","text", "text"];
	private static $listeClass=["","","",""];
	private static $listeLabel = ["","","Libellé de la taille", "Référence de la taille"];
	private static $nbColonne= 4;
	
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

	public static function getListeTypeInput()
	{
		return self::$listeTypeInput;
	}


	public static function getListeLabel()
	{
		return self::$listeLabel;
	}
	public function getLibelle()
	{
		return $this->getLibTaille();
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
		return "IdTaille : ".$this->getIdTaille()."LibTaille : ".$this->getLibTaille()."RefTaille : ".$this->getRefTaille()."\n";
	}

}