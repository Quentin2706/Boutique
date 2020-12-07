<?php
class Fournisseur
{
    private $_idFournisseur;
    private $_refFournisseur;
    private $_libFournisseur;
    private $_adresseFournisseur;
    private $_telephoneFournisseur;

    public function getIdFournisseur()
    {
        return $this->_idFournisseur;
    }
    public function setIdFournisseur($_idFournisseur)
    {
        return $this->_idFournisseur = $_idFournisseur;
    }
    public function getRefFournisseur()
    {
        return $this->_refFournisseur;
    }
    public function setRefFournisseur($_refFournisseur)
    {
        return $this->_refFournisseur = $_refFournisseur;
    }
    public function getLibFournisseur()
    {
        return $this->_libFournisseur;
    }
    public function setLibFournisseur($_libFournisseur)
    {
        return $this->_libFournisseur = $_libFournisseur;
    }
    public function getAdresseFournisseur()
    {
        return $this->_adresseFournisseur;
    }
    public function setAdresseFournisseur($_adresseFournisseur)
    {
        return $this->_adresseFournisseur = $_adresseFournisseur;
    }
    public function getTelephoneFournisseur()
    {
        return $this->_telephoneFournisseur;
    }
    public function setTelephoneFournisseur($_telephoneFournisseur)
    {
        return $this->_telephoneFournisseur = $_telephoneFournisseur;
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
