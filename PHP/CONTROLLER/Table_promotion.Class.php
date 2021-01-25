<?php

class Table_promotion
{

    /*****************Attributs***************** */
    //CLE ETRANGERE

    private static $listeAttributs = ["Table_promotion", "idPromotion", "idCateg", "dateDebut", "dateFin", "taux"];
    private static $listeTypeInput = ["", "", "select", "date", "date", "text"];
    private static $listeClass = ["", "", "categ", "", "", ""];
    private static $listeLabel = ["", "", "Catégorie", "Date de début", "Date de fin", "Taux de la promotion"];
    private static $nbColonne= 6;
	
    private $_idPromotion;
    private $_idCateg;
    private $_dateDebut;
    private $_dateFin;
    private $_taux;

    private $_categ;

    /***************** Accesseurs ***************** */

    public function getIdPromotion()
    {
        return $this->_idPromotion;
    }

    public function setIdPromotion($idPromotion)
    {
        $this->_idPromotion = $idPromotion;
    }

    public function getIdCateg()
    {
        return $this->_idCateg;
    }

    public function setIdCateg($idCateg)
    {
        $this->_idCateg = $idCateg;
        $this->setCateg(Table_categManager::findById($idCateg));
    }

    public function getDateDebut()
    {
        return $this->_dateDebut;
    }

    public function setDateDebut($dateDebut)
    {
        $this->_dateDebut = $dateDebut;
    }

    public function getDateFin()
    {
        return $this->_dateFin;
    }

    public function setDateFin($dateFin)
    {
        $this->_dateFin = $dateFin;
    }

    public function getTaux()
    {
        return $this->_taux;
    }

    public function setTaux($taux)
    {
        $this->_taux = $taux;
    }

    public function getCateg()
    {
        return $this->_categ;
    }

    public function setCateg($categ)
    {
        $this->_categ = $categ;
    }

    public function getLibCateg()
    {
        return ($this->getCateg())->getLibCateg();
    }

    public static function getListeAttributs()
    {
        return self::$listeAttributs;
    }

    public static function getListeTypeInput()
    {
        return self::$listeTypeInput;
    }

    public static function getListeClass()
    {
        return self::$listeClass;
    }

    public static function getListeLabel()
    {
        return self::$listeLabel;
    }
    public static function getNbColonne()
	{
		return self::$nbColonne;
	}
    /*****************Constructeur***************** */

    public function __construct(array $options = [])
    {
        if (!empty($options)) // empty : renvoi vrai si le tableau est vide
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
            {
                $this->$methode($value);
            }
        }
    }

    /*****************Autres Méthodes***************** */

    /**
     * Transforme l'objet en chaine de caractères
     *
     * @return String
     */
    public function toString()
    {
        return "IdPromotion : " . $this->getIdPromotion() . "IdCateg : " . $this->getIdCateg() . "DateDebut : " . $this->getDateDebut() . "DateFin : " . $this->getDateFin() . "Taux : " . $this->getTaux() . "\n";
    }

}
