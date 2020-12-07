<?php
class Categorie
{
    private $_idCateg;
    private $_refCateg;
    private $_libCateg;
    private $_idUnivers;

    public function getIdCateg()
    {
        return $this->_idCateg;
    }
    public function setIdCateg($_idCateg)
    {
        return $this->_idCateg = $_idCateg;
    }
    public function getRefCateg()
    {
        return $this->_refCateg;
    }
    public function setRefCateg($_refCateg)
    {
        return $this->_refCateg = $_refCateg;
    }
    public function getLibCateg()
    {
        return $this->_libCateg;
    }
    public function setLibCateg($_libCateg)
    {
        return $this->_libCateg = $_libCateg;
    }
    public function getIdUnivers()
    {
        return $this->_idUnivers;
    }
    public function setIdUnivers($_idUnivers)
    {
        return $this->_idUnivers = $_idUnivers;
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
