<?php
class Couleur
{
    private $_idCouleur;
    private $_libCouleur;
    private $_refCouleur;

    public function getIdCouleur()
    {
        return $this->_idCouleur;
    }
    public function setIdCouleur($_idCouleur)
    {
        return $this->_idCouleur = $_idCouleur;
    }
    public function getLibCouleur()
    {
        return $this->_libCouleur;
    }
    public function setLibCouleur($_libCouleur)
    {
        return $this->_libCouleur = $_libCouleur;
    }
    public function getRefCouleur()
    {
        return $this->_refCouleur;
    }
    public function setRefCouleur($_refCouleur)
    {
        return $this->_refCouleur = $_refCouleur;
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
