<?php

class Table_vente 
{

	/*****************Attributs***************** */

	//CLE ETRANGERE
	private static $listeAttributs = ["Table_vente","idVente","date_vente", "idClient"];
	private static $listeTypeInput = ["","","date","select"];
	private static $listeClass = ["","","","client"];
	private static $listeLabel = ["","","Date de la vente", "Client"];
	private static $nbColonne= 4;
	
	private $_idVente;
	private $_date_vente;
	private $_idClient;

	private $_client;

	/***************** Accesseurs ***************** */


	public function getIdVente()
	{
		return $this->_idVente;
	}

	public function setIdVente($idVente)
	{
		$this->_idVente=$idVente;
	}

	public function getDate_vente()
	{
		return $this->_date_vente;
	}

	public function setDate_vente($date_vente)
	{
		$this->_date_vente=$date_vente;
	}

	public function getIdClient()
	{
		return $this->_idClient;
	}

	public function setIdClient($idClient)
	{
		$this->_idClient=$idClient;
		$this->setClient(Table_clientManager::findById($idClient));
	}
	
	public function getClient()
	{
		return $this->_client;
	}

	
	public function setClient($client)
	{
		$this->_client = $client;

	}

	public function getNomClient()
	{
		return ($this->getClient())->getNomClient();
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
	public function getLibelle()
	{
		return $this->getDate_vente();
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
		return "IdVente : ".$this->getIdVente()."Date_vente : ".$this->getDate_vente()."IdClient : ".$this->getIdClient()."\n";
	}
}