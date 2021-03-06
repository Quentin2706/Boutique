<?php

class Table_client
{

    /*****************Attributs***************** */
    private static $listeAttributs = ["Table_client","idClient","nomClient","adresseMail","adressePostale"];
	private static $listeTypeInput = ["","","text","text","text", "text", "text", "text"];
	private static $listeClass = ["","","","", "univers", "categ","fournisseur","couleur","taille","incrementale","lot","", "", "", ""];
    private static $listeLabel = ["","","Nom du Client", "Adresse Mail", "Adresse Postale"];
    private static $nbColonne= 5;
    private $_idClient;
    private $_nomClient;
    private $_adresseMail;
    private $_adressePostale;

    /***************** Accesseurs ***************** */

    public function getIdClient()
    {
        return $this->_idClient;
    }

    public function setIdClient($idClient)
    {
        $this->_idClient = $idClient;
    }

    public function getNomClient()
    {
        return $this->_nomClient;
    }

    public function setNomClient($nomClient)
    {
        $this->_nomClient = $nomClient;
    }

    public function getAdresseMail()
    {
        return $this->_adresseMail;
    }

    public function setAdresseMail($adresseMail)
    {
        $this->_adresseMail = $adresseMail;
    }

    public function getAdressePostale()
    {
        return $this->_adressePostale;
    }

    public function setAdressePostale($adressePostale)
    {
        $this->_adressePostale = $adressePostale;
    }



    public function getLibelle()
    {
        return $this->getNomClient();
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
        return "IdClient : " . $this->getIdClient() . "NomClient : " . $this->getNomClient() . "AdresseMail : " . $this->getAdresseMail() . "AdressePostale : " . $this->getAdressePostale() . "\n";
    }

}
