<?php
class ModePaiement
{
    private $_idModePaiement;
    private $_libModePaiement;

    public function getIdModePaiement()
    {
        return $this->_idModePaiement;
    }
    public function setIdModePaiement($_idModePaiement)
    {
        return $this->_idModePaiement = $_idModePaiement;
    }
    public function getLibModePaiement()
    {
        return $this->_libModePaiement;
    }
    public function setLibModePaiement($_libModePaiement)
    {
        return $this->_libModePaiement = $_libModePaiement;
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
