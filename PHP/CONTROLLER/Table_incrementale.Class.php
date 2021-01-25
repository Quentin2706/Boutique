<?php

class Table_incrementale 
{

	/*****************Attributs***************** */
	private static $listeAttributs=["Table_incrementale","idIncrementale","refIncrementale"];
	private static $listeTypeInput = ["","", "text"];
	private static $listeClass=["","",""];
	private static $listeLabel = ["","","Référence Incrémentale"];
	private static $nbColonne= 3;
	
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



	public function getLibIncrementale()
	{
		return $this->_refIncrementale;
	}	
	public static function getListeTypeInput()
    {
        return self::$listeTypeInput;
    }
    public static function getListeLabel()
    {
        return self::$listeLabel;
    }

    public static function getListeAttributs()
    {
        return self::$listeAttributs;
    }
    public static function getListeClass()
    {
        return self::$listeClass;
	}
	
	public function getLibelle()
	{
		return $this->getLibIncrementale();
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
		return "IdIncrementale : ".$this->getIdIncrementale()."RefIncrementale : ".$this->getRefIncrementale()."\n";
	}


}