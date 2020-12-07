<?php
class Incrementale
{
    private $_idIncrementale;
    private $_refIncrementale;

    public function getIdIncrementale()
    {
        return $this->_idIncrementale;
    }
    public function setIdIncrementale($_idIncrementale)
    {
        return $this->_idIncrementale = $_idIncrementale;
    }
    public function getRefIncrementale()
    {
        return $this->_refIncrementale;
    }
    public function setRefIncrementale($_refIncrementale)
    {
        return $this->_refIncrementale = $_refIncrementale;
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
