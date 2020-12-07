<?php
class DetailVente
{
    private $_idDetailVente;
    private $_idVente;
    private $_quantite;
    private $_idArticle;
    private $_prixUnitaire;
    private $_detailDivers;

    public function getIdDetailVente()
    {
        return $this->_idDetailVente;
    }
    public function setIdDetailVente($_idDetailVente)
    {
        return $this->_idDetailVente = $_idDetailVente;
    }
    public function getIdVente()
    {
        return $this->_idVente;
    }
    public function setIdVente($_idVente)
    {
        return $this->_idVente = $_idVente;
    }
    public function getQuantite()
    {
        return $this->_quantite;
    }
    public function setQuantite($_quantite)
    {
        return $this->_quantite = $_quantite;
    }
    public function getIdArticle()
    {
        return $this->_idArticle;
    }
    public function setIdArticle($_idArticle)
    {
        return $this->_idArticle = $_idArticle;
    }
    public function getPrixUnitaire()
    {
        return $this->_prixUnitaire;
    }
    public function setPrixUnitaire($_prixUnitaire)
    {
        return $this->_prixUnitaire = $_prixUnitaire;
    }
    public function getDetailDivers()
    {
        return $this->_detailDivers;
    }
    public function setDetailDivers($_detailDivers)
    {
        return $this->_detailDivers = $_detailDivers;
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
