<?php

class Table_detail_vente 
{

	/*****************Attributs***************** */
	//CLE ETRANGERE
	private static $listeAttributs =["Table_detail_vente","idDetail_vente","idVente","quantite","idArticle","prixUnitaire","detailDivers"];
	private static $listeTypeInput = ["","", "select", "text","select","text","text"];
	private static $listeClass=["","","vente","","article","",""];
	private static $listeLabel = ["","","Date de la vente","Quantité","Libellé de l'article", "Prix unitaire", "Détails divers"];
	private static $nbColonne= 7;
	private $_idDetail_vente;
	private $_idVente;
	private $_quantite;
	private $_idArticle;
	private $_prixUnitaire;
	private $_detailDivers;

	private $_vente;
	private $_article;

	/***************** Accesseurs ***************** */


	public function getIdDetail_vente()
	{
		return $this->_idDetail_vente;
	}

	public function setIdDetail_vente($idDetail_vente)
	{
		$this->_idDetail_vente=$idDetail_vente;
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
	public static function getListeTypeInput()
	{
		return self::$listeTypeInput;
	}

	public static function getListeLabel()
	{
		return self::$listeLabel;
	}

	public function getVente()
	{
		return $this->_vente;
	}

	
	public function setVente($vente)
	{
		$this->_vente = $vente;

	}

	
	public function getArticle()
	{
		return $this->_article;
	}

	
	public function setArticle($article)
	{
		$this->_article = $article;

	}

	public function getDateVente()
	{
		return ($this->getVente())->getDate_Vente();
	}

	public function getLibArticle()
	{
		return ($this->getArticle())->getLibArticle();
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
	public function getLibelle()
	{
		return $this->getLibArticle();
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
		return "IdDetail_vente : ".$this->getIdDetail_vente()."IdVente : ".$this->getIdVente()."Quantite : ".$this->getQuantite()."IdArticle : ".$this->getIdArticle()."PrixUnitaire : ".$this->getPrixUnitaire()."DetailDivers : ".$this->getDetailDivers()."\n";
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