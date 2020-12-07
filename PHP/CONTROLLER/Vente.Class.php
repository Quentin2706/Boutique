<?php
class Vente
{
    private $_idVente;
    private $_date_vente;
    private $_idClient;

    public function getIdVente()
    {
        return $this->_idVente;
    }
    public function setIdVente($_idVente)
    {
        return $this->_idVente = $_idVente;
    }
    public function getDate_vente()
    {
        return $this->_date_vente;
    }
    public function setDate_vente($_date_vente)
    {
        return $this->_date_vente = $_date_vente;
    }
    public function getIdClient()
    {
        return $this->_idClient;
    }
    public function setIdClient($_idClient)
    {
        return $this->_idClient = $_idClient;
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
