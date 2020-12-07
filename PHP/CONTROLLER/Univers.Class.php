<?php
class Univers
{
    private $_idUnivers;
    private $_refUnivers;
    private $_libUnivers;

    public function getIdUnivers()
    {
        return $this->_idUnivers;
    }
    public function setIdUnivers($_idUnivers)
    {
        return $this->_idUnivers = $_idUnivers;
    }
    public function getRefUnivers()
    {
        return $this->_refUnivers;
    }
    public function setRefUnivers($_refUnivers)
    {
        return $this->_refUnivers = $_refUnivers;
    }
    public function getLibUnivers()
    {
        return $this->_libUnivers;
    }
    public function setLibUnivers($_libUnivers)
    {
        return $this->_libUnivers = $_libUnivers;
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
