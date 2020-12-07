<?php
class Article
{
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
    private $_quantiteStocke;
    private $_prixAchat;
    private $_prixVente;
    private $_seuil;

    public function getIdArticle()
    {
        return $this->_idArticle;
    }
    public function setIdArticle($_idArticle)
    {
        return $this->_idArticle = $_idArticle;
    }
    public function getRefArticle()
    {
        return $this->_refArticle;
    }
    public function setRefArticle($_refArticle)
    {
        return $this->_refArticle = $_refArticle;
    }
    public function getLibArticle()
    {
        return $this->_libArticle;
    }
    public function setLibArticle($_libArticle)
    {
        return $this->_libArticle = $_libArticle;
    }
    public function getIdUnivers()
    {
        return $this->_idUnivers;
    }
    public function setIdUnivers($_idUnivers)
    {
        return $this->_idUnivers = $_idUnivers;
    }
    public function getIdCateg()
    {
        return $this->_idCateg;
    }
    public function setIdCateg($_idCateg)
    {
        return $this->_idCateg = $_idCateg;
    }
    public function getIdFournisseur()
    {
        return $this->_idFournisseur;
    }
    public function setIdFournisseur($_idFournisseur)
    {
        return $this->_idFournisseur = $_idFournisseur;
    }
    public function getIdCouleur()
    {
        return $this->_idCouleur;
    }
    public function setIdCouleur($_idCouleur)
    {
        return $this->_idCouleur = $_idCouleur;
    }
    public function getIdTaille()
    {
        return $this->_idTaille;
    }
    public function setIdTaille($_idTaille)
    {
        return $this->_idTaille = $_idTaille;
    }
    public function getIdIncrementale()
    {
        return $this->_idIncrementale;
    }
    public function setIdIncrementale($_idIncrementale)
    {
        return $this->_idIncrementale = $_idIncrementale;
    }
    public function getIdLot()
    {
        return $this->_idLot;
    }
    public function setIdLot($_idLot)
    {
        return $this->_idLot = $_idLot;
    }
    public function getQuantiteStocke()
    {
        return $this->_quantiteStocke;
    }
    public function setQuantiteStocke($_quantiteStocke)
    {
        return $this->_quantiteStocke = $_quantiteStocke;
    }
    public function getPrixAchat()
    {
        return $this->_prixAchat;
    }
    public function setPrixAchat($_prixAchat)
    {
        return $this->_prixAchat = $_prixAchat;
    }
    public function getPrixVente()
    {
        return $this->_prixVente;
    }
    public function setPrixVente($_prixVente)
    {
        return $this->_prixVente = $_prixVente;
    }
    public function getSeuil()
    {
        return $this->_seuil;
    }
    public function setSeuil($_seuil)
    {
        return $this->_seuil = $_seuil;
    }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable(([$this, $methode]))) {
                $this->$methode($value);
            }
        }
    }

}
