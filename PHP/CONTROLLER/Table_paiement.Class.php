<?php

class Table_paiement 
{

	/*****************Attributs***************** */
	//CLE ETRANGERE
	private $listeTypeInput = ["number","text", "hidden", "select"];
	private $listeInfos = ["Table_paiement","idpaiement","date_vente","libModePaiement","montant","nomClient","banque"];
	private $listeLabel = ["Date de la vente", "Mode de paiement", "Montant","Nom du Client","Banque"];
	private $_idpaiement;
	private $_idVente;
	private $_idmodePaiement;
	private $_montant;
	private $_idClient;
	private $_banque;

	private $_vente;
	private $_modePaiement;
	private $_client;

	/***************** Accesseurs ***************** */


	public function getIdpaiement()
	{
		return $this->_idpaiement;
	}

	public function setIdpaiement($idpaiement)
	{
		$this->_idpaiement=$idpaiement;
	}

	public function getIdVente()
	{
		return $this->_idVente;
	}

	public function setIdVente($idVente)
	{
		$this->_idVente=$idVente;
		$this->setVente(Table_venteManager::findById($idVente));
	}

	public function getIdmodePaiement()
	{
		return $this->_idmodePaiement;
	}

	public function setIdmodePaiement($idmodePaiement)
	{
		$this->_idmodePaiement=$idmodePaiement;
		$this->setModepaiement(Table_modepaiementManager::findById($idModepaiement));
	}

	public function getMontant()
	{
		return $this->_montant;
	}

	public function setMontant($montant)
	{
		$this->_montant=$montant;
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

	public function getBanque()
	{
		return $this->_banque;
	}

	public function setBanque($banque)
	{
		$this->_banque=$banque;
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

	public function getVente()
	{
		return $this->_vente;
	}

	
	public function setVente($vente)
	{
		$this->_vente = $vente;

	}

	
	public function getModePaiement()
	{
		return $this->_modePaiement;
	}

	
	public function setModePaiement($modePaiement)
	{
		$this->_modePaiement = $modePaiement;


	}

	
	public function getClient()
	{
		return $this->_client;
	}

	
	public function setClient($client)
	{
		$this->_client = $client;


	}

	public function getDate_vente()
	{
		return ($this->getVente())->getDate_Vente();
	}

	public function getLibModePaiement()
	{
		return ($this->getModePaiement())->getLibeModePaiement();
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
		return "Idpaiement : ".$this->getIdpaiement()."IdVente : ".$this->getIdVente()."IdmodePaiement : ".$this->getIdmodePaiement()."Montant : ".$this->getMontant()."IdClient : ".$this->getIdClient()."Banque : ".$this->getBanque()."\n";
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