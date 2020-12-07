<?php
class Paiement
{
    private $_idpaiement;
    private $_idVente;
    private $_idmodePaiement;
    private $_montant;
    private $_idClient;
    private $_banque;

    public function getIdpaiement()
    {
        return $this->_idpaiement;
    }
    public function setIdpaiement($_idpaiement)
    {
        return $this->_idpaiement = $_idpaiement;
    }
    public function getIdVente()
    {
        return $this->_idVente;
    }
    public function setIdVente($_idVente)
    {
        return $this->_idVente = $_idVente;
    }
    public function getIdmodePaiement()
    {
        return $this->_idmodePaiement;
    }
    public function setIdmodePaiement($_idmodePaiement)
    {
        return $this->_idmodePaiement = $_idmodePaiement;
    }
    public function getMontant()
    {
        return $this->_montant;
    }
    public function setMontant($_montant)
    {
        return $this->_montant = $_montant;
    }
    public function getIdClient()
    {
        return $this->_idClient;
    }
    public function setIdClient($_idClient)
    {
        return $this->_idClient = $_idClient;
    }
    public function getBanque()
    {
        return $this->_banque;
    }
    public function setBanque($_banque)
    {
        return $this->_banque = $_banque;
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
