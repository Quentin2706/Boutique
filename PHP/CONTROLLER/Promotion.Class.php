<?php
class Promotion
{
    private $_idPromotion;
    private $_idCateg;
    private $_dateDebut;
    private $_dateFin;
    private $_taux;

    public function getIdPromotion()
    {
        return $this->_idPromotion;
    }
    public function setIdPromotion($_idPromotion)
    {
        return $this->_idPromotion = $_idPromotion;
    }
    public function getIdCateg()
    {
        return $this->_idCateg;
    }
    public function setIdCateg($_idCateg)
    {
        return $this->_idCateg = $_idCateg;
    }
    public function getDateDebut()
    {
        return $this->_dateDebut;
    }
    public function setDateDebut($_dateDebut)
    {
        return $this->_dateDebut = $_dateDebut;
    }
    public function getDateFin()
    {
        return $this->_dateFin;
    }
    public function setDateFin($_dateFin)
    {
        return $this->_dateFin = $_dateFin;
    }
    public function getTaux()
    {
        return $this->_taux;
    }
    public function setTaux($_taux)
    {
        return $this->_taux = $_taux;
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
