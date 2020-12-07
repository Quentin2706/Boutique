<?php
class Taille
{
    private $_idTaille;
    private $_libTaille;
    private $_refTaille;

    public function getIdTaille()
    {
        return $this->_idTaille;
    }
    public function setIdTaille($_idTaille)
    {
        return $this->_idTaille = $_idTaille;
    }
    public function getLibTaille()
    {
        return $this->_libTaille;
    }
    public function setLibTaille($_libTaille)
    {
        return $this->_libTaille = $_libTaille;
    }
    public function getRefTaille()
    {
        return $this->_refTaille;
    }
    public function setRefTaille($_refTaille)
    {
        return $this->_refTaille = $_refTaille;
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
