<?php

class Table_vente 
{

	/*****************Attributs***************** */

	//CLE ETRANGERE
	private $listeTypeInput = ["number","text", "hidden", "select","date"];
	private $listeInfos = ["Table_vente","idVente","date_vente","nomClient"];
	private $listeLabel = ["Date de la vente", "Nom du Client"];
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

	public function getClient()
	{
		return $this->_client;
	}

	
	public function setClient($client)
	{
		$this->_client = $client;

		return $this;
	}

	public function getNomClient()
	{
		return ($this->getClient())->getNomClient();
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