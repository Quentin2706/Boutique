<?php

class Table_univers
{

    /*****************Attributs***************** */
    private static $listeTypeInput = ["", "hidden", "text", "text"];
    private static $listeAttributs = ["Table_univers", "idUnivers", "refUnivers", "libUnivers"];
    private static $listeLabel = ["", "", "Référence de l'univers", "Libellé de l'univers"];
    private static $nbColonne= 4;
	
    private static $listeClass;
    private $_idUnivers;
    private $_refUnivers;
    private $_libUnivers;

    /***************** Accesseurs ***************** */

    public function getIdUnivers()
    {
        return $this->_idUnivers;
    }

    public function setIdUnivers($idUnivers)
    {
        $this->_idUnivers = $idUnivers;
    }

    public function getRefUnivers()
    {
        return $this->_refUnivers;
    }

    public function setRefUnivers($refUnivers)
    {
        $this->_refUnivers = $refUnivers;
    }

    public function getLibUnivers()
    {
        return $this->_libUnivers;
    }

    public function setLibUnivers($libUnivers)
    {
        $this->_libUnivers = $libUnivers;
    }
    public function getLibelle()
    {
        return $this->getLibUnivers();
    }
    public static function getListeTypeInput()
    {
        return self::$listeTypeInput;
    }

    public static function getListeLabel()
    {
        return self::$listeLabel;
    }

    public static function getListeAttributs()
    {
        return self::$listeAttributs;
    }
    public static function getListeClass()
    {
        return self::$listeClass;
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
        foreach ($data as $key => $value)
        {
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
        return "IdUnivers : " . $this->getIdUnivers() . "RefUnivers : " . $this->getRefUnivers() . "LibUnivers : " . $this->getLibUnivers() . "\n";
    }
}
