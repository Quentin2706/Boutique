<?php

class Table_article 
{

	/*****************Attributs***************** */
	//CLE ETRANGERE
	
	private $listeInfos = ["Table_article","idArticle","refArticle","libArticle","libUnivers","libCateg","libFournisseur","libCouleur","libTaille","libIncrementale","libLot","quantiteStock","prixAchat","prixVente","seuil"];
	private $listeInfosForm = ["Table_article","idArticle","refArticle","libArticle","idUnivers","idCateg","idFournisseur","idCouleur","idTaille","idIncrementale","idLot","quantiteStock","prixAchat","prixVente","seuil"];
	private $listeTypeInput = ["text","text", "select", "select","select","select","select","select","select","text", "text", "text", "text"];
	private $listeClass = ["","", "univers", "categ","fournisseur","couleur","taille","incrementale","lot","", "", "", ""];
	private $listeLabel = ["Référence de l'article", "Libelle de l'article", "Libellé de l'Univers","Libellé de la catégorie","Libellé du Fournisseur","Libellé de la couleur","Libellé de la taille","Référence incrémentale","Référence du lot","Quantité en stock","Prix à l'achat","Prix à la vente","Seuil"];
	private $_idArticle;
	private $_refArticle;
	private $_libArticle;
	private $_idUnivers;
	private $_idCateg;
	private $_idFournisseur;
	private $_idCouleur;
	private $_idTaille;
	private $_idIncrementale;
	private $_idLot;
	private $_quantiteStock;
	private $_prixAchat;
	private $_prixVente;
	private $_seuil;
	
	private $_univers;
	private $_categ;
	private $_fournisseur;
	private $_couleur;
	private $_taille;
	private $_lot;
	private $_incrementale;

	/***************** Accesseurs ******************/


	public function getIdArticle()
	{
		return $this->_idArticle;
	}

	public function setIdArticle($idArticle)
	{
		$this->_idArticle=$idArticle;
	}

	public function getRefArticle()
	{
		return $this->_refArticle;
	}

	public function setRefArticle($refArticle)
	{
		$this->_refArticle=$refArticle;
	}

	public function getLibArticle()
	{
		return $this->_libArticle;
	}

	public function setLibArticle($libArticle)
	{
		$this->_libArticle=$libArticle;
	}

	public function getIdUnivers()
	{
		return $this->_idUnivers;
	}

	public function setIdUnivers($idUnivers)
	{
		$this->_idUnivers=$idUnivers;
		$this->setUnivers(Table_universManager::findById($idUnivers));
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

	public function getIdFournisseur()
	{
		return $this->_idFournisseur;
	}

	public function setIdFournisseur($idFournisseur)
	{
		$this->_idFournisseur=$idFournisseur;
		$this->setFournisseur(Table_fournisseurManager::findById($idFournisseur));
	}

	public function getIdCouleur()
	{
		return $this->_idCouleur;
	}

	public function setIdCouleur($idCouleur)
	{
		$this->_idCouleur=$idCouleur;
		$this->setCouleur(Table_couleurManager::findById($idCouleur));
	}

	public function getIdTaille()
	{
		return $this->_idTaille;
	}

	public function setIdTaille($idTaille)
	{
		$this->_idTaille=$idTaille;
		$this->setTaille(Table_tailleManager::findById($idTaille));
	}

	public function getIdIncrementale()
	{
		return $this->_idIncrementale;
	}

	public function setIdIncrementale($idIncrementale)
	{
		$this->_idIncrementale=$idIncrementale;
		$this->setIncrementale(Table_incrementaleManager::findById($idIncrementale));
	}

	public function getIdLot()
	{
		return $this->_idLot;
	}

	public function setIdLot($idLot)
	{
		$this->_idLot=$idLot;
		$this->setLot(Table_lotManager::findById($idLot));
	}

	public function getQuantiteStock()
	{
		return $this->_quantiteStock;
	}

	public function setQuantiteStock($quantiteStock)
	{
		$this->_quantiteStock=$quantiteStock;
	}

	public function getPrixAchat()
	{
		return $this->_prixAchat;
	}

	public function setPrixAchat($prixAchat)
	{
		$this->_prixAchat=$prixAchat;
	}

	public function getPrixVente()
	{
		return $this->_prixVente;
	}

	public function setPrixVente($prixVente)
	{
		$this->_prixVente=$prixVente;
	}

	public function getSeuil()
	{
		return $this->_seuil;
	}

	public function setSeuil($seuil)
	{
		$this->_seuil=$seuil;
	}

	public function getUnivers()
	{
		return $this->_univers;
	}

	
	public function setunivers($univers)
	{
		$this->_univers = $univers;

	}

	
	public function getCateg()
	{
		return $this->_categ;
	}

	
	public function setCateg($categ)
	{
		$this->_categ = $categ;

	}

	
	public function getFournisseur()
	{
		return $this->_fournisseur;
	}

	
	public function setFournisseur($fournisseur)
	{
		$this->_fournisseur = $fournisseur;

	}

	
	public function getCouleur()
	{
		return $this->_couleur;
	}

	
	public function setCouleur($couleur)
	{
		$this->_couleur = $couleur;


	}

	
	public function getTaille()
	{
		return $this->_taille;
	}

	 
	public function setTaille($taille)
	{
		$this->_taille = $taille;

	}

	 
	public function getLot()
	{
		return $this->_lot;
	}

	
	public function setLot($lot)
	{
		$this->_lot = $lot;


	}

	public function getIncrementale()
	{
		return $this->_incrementale;
	}

	
	public function setIncrementale($incrementale)
	{
		$this->_incrementale = $incrementale;

	}

	public function getLibUnivers()
	{
		return ($this->getUnivers())->getLibUnivers();
	}

	public function getLibCateg()
	{
		return($this->getCateg())->getLibCateg();
	}

	public function getLibFournisseur()
	{
		return ($this->getFournisseur())->getLibFournisseur();
	}

	public function getLibCouleur()
	{
		return ($this->getCouleur())->getLibCouleur();
	}

	public function getLibTaille()
	{
		return ($this->getTaille())->getLibTaille();
	}

	public function getLibLot()
	{
		return ($this->getLot())->getRefLot();
	}

	public function getLibIncrementale()
	{
		return ($this->getIncrementale())->getRefIncrementale();
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

	public function getListeInfosForm()
	{
		return $this->listeInfosForm;
	}

	public function getListeClass()
	{
		return $this->listeClass;
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
		return "IdArticle : ".$this->getIdArticle()."RefArticle : ".$this->getRefArticle()."LibArticle : ".$this->getLibArticle()."IdUnivers : ".$this->getIdUnivers()."IdCateg : ".$this->getIdCateg()."IdFournisseur : ".$this->getIdFournisseur()."IdCouleur : ".$this->getIdCouleur()."IdTaille : ".$this->getIdTaille()."IdIncrementale : ".$this->getIdIncrementale()."IdLot : ".$this->getIdLot()."QuantiteStock : ".$this->getQuantiteStock()."PrixAchat : ".$this->getPrixAchat()."PrixVente : ".$this->getPrixVente()."Seuil : ".$this->getSeuil()."\n";
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