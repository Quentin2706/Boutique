<?php
class Lot
{
    private $_idLot;
    private $_reflot;

    public function getIdLot()
    {
        return $this->_idLot;
    }
    public function setIdLot($_idLot)
    {
        return $this->_idLot = $_idLot;
    }
    public function getReflot()
    {
        return $this->_reflot;
    }
    public function setReflot($_reflot)
    {
        return $this->_reflot = $_reflot;
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
