<?php
class Client
{
    private $_idClient;
    private $_nomClient;
    private $_adresseMail;
    private $_adressePostale;

    public function getIdClient()
    {
        return $this->_idClient;
    }
    public function setIdClient($_idClient)
    {
        return $this->_idClient = $_idClient;
    }
    public function getNomClient()
    {
        return $this->_nomClient;
    }
    public function setNomClient($_nomClient)
    {
        return $this->_nomClient = $_nomClient;
    }
    public function getAdresseMail()
    {
        return $this->_adresseMail;
    }
    public function setAdresseMail($_adresseMail)
    {
        return $this->_adresseMail = $_adresseMail;
    }
    public function getAdressePostale()
    {
        return $this->_adressePostale;
    }
    public function setAdressePostale($_adressePostale)
    {
        return $this->_adressePostale = $_adressePostale;
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
