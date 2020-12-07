<?php

class Table_user 
{

	/*****************Attributs***************** */

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

	public function setRole($role)
	{
		$this->_role=$role;
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