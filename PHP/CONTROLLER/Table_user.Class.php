<?php

class Table_user 
{

	/*****************Attributs***************** */

	private static $listeAttributs = ["Table_user","idUser","pseudo","password","role"];
	private static $listeTypeInput = ["","hidden","text","password","select"];
	private static $listeClass = ["","","","", "user"];
	private static $listeLabel = ["","","Identifiant", "password", "Role"];
	private static $nbColonne= 5;
	private $_iduser;
	private $_pseudo;
	private $_password;
	private $_role;

	/***************** Accesseurs ***************** */


	public function getIduser()
	{
		return $this->_iduser;
	}

	public function setIduser($iduser)
	{
		$this->_iduser=$iduser;
	}

	public function getPseudo()
	{
		return $this->_pseudo;
	}

	public function getLibelle()
	{
		return $this->getPseudo();
	}
	public function setPseudo($pseudo)
	{
		$this->_pseudo=$pseudo;
	}

	public function getPassword()
	{
		return $this->_password;
	}

	public function setPassword($password)
	{
		$this->_password=$password;
	}

	public function getRole()
	{
		return $this->_role;
	}

	public function setRole(int $role)
	{
		$this->_role=$role;
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
		return "Iduser : ".$this->getIduser()."Pseudo : ".$this->getPseudo()."Password : ".$this->getPassword()."Role : ".$this->getRole()."\n";
	}
}