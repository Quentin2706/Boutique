<?php

class Table_promotion 
{

	/*****************Attributs***************** */
	//CLE ETRANGERE

	private $listeTypeInput = ["number","text", "hidden", "select","date"];
	private $listeInfos = ["Table_promotion","idPromotion","libCateg","dateDebut","dateFin","taux"];
	private $listeLabel = ["Libellé de la Categorie", "Date de début", "Date de fin","Taux"];
	private $_idPromotion;
	private $_idCateg;
	private $_dateDebut;
	private $_dateFin;
	private $_taux;

	private $_categ;

	/***************** Accesseurs ***************** */


	public function getIdPromotion()
	{
		return $this->_idPromotion;
	}

	public function setIdPromotion($idPromotion)
	{
		$this->_idPromotion=$idPromotion;
	}

	public function getIdCateg()
	{
		return $this->_idCateg;
	}

	public function setIdCateg($idCateg)
	{
		$this->_idCateg=$idCateg;
		$this->setCateg(Table_categManager::findById($idCateg));
	}

	public function getDateDebut()
	{
		return $this->_dateDebut;
	}

	public function setDateDebut($dateDebut)
	{
		$this->_dateDebut=$dateDebut;
	}

	public function getDateFin()
	{
		return $this->_dateFin;
	}

	public function setDateFin($dateFin)
	{
		$this->_dateFin=$dateFin;
	}

	public function getTaux()
	{
		return $this->_taux;
	}

	public function setTaux($taux)
	{
		$this->_taux=$taux;
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

	public function getCateg()
	{
		return $this->_categ;
	}

	
	public function setCateg($categ)
	{
		$this->_categ = $promotion;

		return $this;
	}

	public function getLibCateg()
	{
		return ($this->getCateg())->getLibCateg();
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
		return "IdPromotion : ".$this->getIdPromotion()."IdCateg : ".$this->getIdCateg()."DateDebut : ".$this->getDateDebut()."DateFin : ".$this->getDateFin()."Taux : ".$this->getTaux()."\n";
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