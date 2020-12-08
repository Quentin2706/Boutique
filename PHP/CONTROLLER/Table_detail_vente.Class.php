<?php

class Table_detail_vente 
{

	/*****************Attributs***************** */
	//CLE ETRANGERE
	private $listeTypeInput = ["number","text", "hidden", "select"];
	private $listeInfos = ["Table_detail_vente","idDetailVente","date_vente","quantite","libArticle","prixUnitaire","detailDivers"];
	private $listeLabel = ["Date de la vente","Quantité","Libellé de l'article", "Prix unitaire", "Détails divers"];
	private $_idDetailVente;
	private $_idVente;
	private $_quantite;
	private $_idArticle;
	private $_prixUnitaire;
	private $_detailDivers;

	private $_vente;
	private $_article;

	/***************** Accesseurs ***************** */


	public function getIdDetailVente()
	{
		return $this->_idDetailVente;
	}

	public function setIdDetailVente($idDetailVente)
	{
		$this->_idDetailVente=$idDetailVente;
	}

	public function getIdVente()
	{
		return $this->_idVente;
	}

	public function setIdVente(int $idVente)
	{
		$this->_idVente=$idVente;
		$this->setVente(Table_venteManager::findById($idVente));
	}

	public function getQuantite()
	{
		return $this->_quantite;
	}

	public function setQuantite($quantite)
	{
		$this->_quantite=$quantite;
	}

	public function getIdArticle()
	{
		return $this->_idArticle;
	}

	public function setIdArticle(int $idArticle)
	{
		$this->_idArticle=$idArticle;
		$this->setArticle(Table_articleManager::findById($idArticle));
	}

	public function getPrixUnitaire()
	{
		return $this->_prixUnitaire;
	}

	public function setPrixUnitaire($prixUnitaire)
	{
		$this->_prixUnitaire=$prixUnitaire;
	}

	public function getDetailDivers()
	{
		return $this->_detailDivers;
	}

	public function setDetailDivers($detailDivers)
	{
		$this->_detailDivers=$detailDivers;
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

		return $this;
	}

	
	public function getArticle()
	{
		return $this->_article;
	}

	
	public function setArticle($article)
	{
		$this->_article = $article;

		return $this;
	}

	public function getDateVente()
	{
		return ($this->getVente())->getDate_Vente();
	}

	public function getLibArticle()
	{
		return ($this->getArticle())->getLibArticle();
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
		return "IdDetailVente : ".$this->getIdDetailVente()."IdVente : ".$this->getIdVente()."Quantite : ".$this->getQuantite()."IdArticle : ".$this->getIdArticle()."PrixUnitaire : ".$this->getPrixUnitaire()."DetailDivers : ".$this->getDetailDivers()."\n";
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