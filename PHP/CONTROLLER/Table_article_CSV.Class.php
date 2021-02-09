<?php

Class Table_article_CSV {
	/***************************************** Attributs **********************************************/

	private $_refArticle ;
	private $_libArticle ;
	private $_refUnivers ;
	private $_libUnivers ;
	private $_refCateg ;
	private $_libCateg ;
	private $_refFournisseur ;
	private $_libFournisseur ;
	private $_refCouleur ;
	private $_libCouleur ;
	private $_refTaille ;
	private $_libTaille ;
	private $_refIncrementale ;
	private $_reflot ;
	private $_quantiteStock ;
	private $_prixAchat ;
	private $_prixVente ;
	private $_seuil ;


	/***************************************** Accesseurs **********************************************/
	
	public function getRefArticle()
	{
		return $this->_refArticle;
	}

	public function setRefArticle($refArticle)
	{
		$this->_refArticle = $refArticle;
	}
	public function getLibArticle()
	{
		return $this->_libArticle;
	}

	public function setLibArticle($libArticle)
	{
		$this->_libArticle = $libArticle;
	}
	public function getRefUnivers()
	{
		return $this->_refUnivers;
	}

	public function setRefUnivers($refUnivers)
	{
		$this->_refUnivers = $refUnivers;
	}
	public function getLibUnivers()
	{
		return $this->_libUnivers;
	}

	public function setLibUnivers($libUnivers)
	{
		$this->_libUnivers = $libUnivers;
	}
	public function getRefCateg()
	{
		return $this->_refCateg;
	}

	public function setRefCateg($refCateg)
	{
		$this->_refCateg = $refCateg;
	}
	public function getLibCateg()
	{
		return $this->_libCateg;
	}

	public function setLibCateg($libCateg)
	{
		$this->_libCateg = $libCateg;
	}
	public function getRefFournisseur()
	{
		return $this->_refFournisseur;
	}

	public function setRefFournisseur($refFournisseur)
	{
		$this->_refFournisseur = $refFournisseur;
	}
	public function getLibFournisseur()
	{
		return $this->_libFournisseur;
	}

	public function setLibFournisseur($libFournisseur)
	{
		$this->_libFournisseur = $libFournisseur;
	}
	public function getRefCouleur()
	{
		return $this->_refCouleur;
	}

	public function setRefCouleur($refCouleur)
	{
		$this->_refCouleur = $refCouleur;
	}
	public function getLibCouleur()
	{
		return $this->_libCouleur;
	}

	public function setLibCouleur($libCouleur)
	{
		$this->_libCouleur = $libCouleur;
	}
	public function getRefTaille()
	{
		return $this->_refTaille;
	}

	public function setRefTaille($refTaille)
	{
		$this->_refTaille = $refTaille;
	}
	public function getLibTaille()
	{
		return $this->_libTaille;
	}

	public function setLibTaille($libTaille)
	{
		$this->_libTaille = $libTaille;
	}
	public function getRefIncrementale()
	{
		return $this->_refIncrementale;
	}

	public function setRefIncrementale($refIncrementale)
	{
		$this->_refIncrementale = $refIncrementale;
	}
	public function getReflot()
	{
		return $this->_reflot;
	}

	public function setReflot($reflot)
	{
		$this->_reflot = $reflot;
	}
	public function getQuantiteStock()
	{
		return $this->_quantiteStock;
	}

	public function setQuantiteStock($quantiteStock)
	{
		$this->_quantiteStock = $quantiteStock;
	}
	public function getPrixAchat()
	{
		return $this->_prixAchat;
	}

	public function setPrixAchat($prixAchat)
	{
		$this->_prixAchat = $prixAchat;
	}
	public function getPrixVente()
	{
		return $this->_prixVente;
	}

	public function setPrixVente($prixVente)
	{
		$this->_prixVente = $prixVente;
	}
	public function getSeuil()
	{
		return $this->_seuil;
	}

	public function setSeuil($seuil)
	{
		$this->_seuil = $seuil;
	}
	

	/***************************************** Constructeur **********************************************/

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
			$methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
			if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
			{
				$this->$methode($value);
			}
		}
	}

	/***************************************** Methode **********************************************/

	/**
	* Transforme l'objet en chaine de caractères
	*
	* @return String
	*/
	public function toString(){
		return " refArticle : ".$this->getRefArticle()	." libArticle : ".$this->getLibArticle()	." refUnivers : ".$this->getRefUnivers()	." libUnivers : ".$this->getLibUnivers()	." refCateg : ".$this->getRefCateg()	." libCateg : ".$this->getLibCateg()	." refFournisseur : ".$this->getRefFournisseur()	." libFournisseur : ".$this->getLibFournisseur()	." refCouleur : ".$this->getRefCouleur()	." libCouleur : ".$this->getLibCouleur()	." refTaille : ".$this->getRefTaille()	." libTaille : ".$this->getLibTaille()	." refIncrementale : ".$this->getRefIncrementale()	." reflot : ".$this->getReflot()	." quantiteStock : ".$this->getQuantiteStock()	." prixAchat : ".$this->getPrixAchat()	." prixVente : ".$this->getPrixVente()	." seuil : ".$this->getSeuil()	;
	}

	/**
	* Renvoi vrai si l'objet en paramètre est égal à l'objet appelant
	*
	* @param [type] obj
	* @return bool
	*/
	public function equalsTo(){
		return  "";
	}

	/**
	* Compare 2 objets
	* Renvoi 1 si le 1er est >
	*        0 si ils sont égaux
	*        -1 si le 1er est <
	*
	* @param [type] obj1
	* @param [type] obj2
	* @return void
	*/
	public function compareTo(){
		return "";
	}

}