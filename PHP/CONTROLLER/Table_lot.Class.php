<?php

class Table_lot 
{

	/*****************Attributs***************** */
	private static $listeAttributs = ["Table_lot","idlot","reflot"];
	private static $listeTypeInput = ["","","text"];
	private static $listeClass = ["","",""];
	private static $listeLabel = ["","","Référence du lot"];
	private static $nbColonne= 3;
	
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


	
	
	public function getLibLot()
	{
		return $this->_refLot;
	}
	public function getLibelle()
	{
		return $this->getRefLot();
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
		return "IdLot : ".$this->getIdLot()."Reflot : ".$this->getRefLot()."\n";
	}


}