<?php

class Table_client
{

    /*****************Attributs***************** */
    private $listeTypeInput = ["number", "text", "hidden", "select"];
    private $listeInfos = ["Table_client", "idClient", "nomClient", "adresseMail", "adressePostale"];
    private $listeLabel = ["Nom du  Client", "Adresse mail du Client", "Adresse Postale du client"];
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
    public function getListeTypeInput()
    {
        return $this->listeTypeInput;
    }

    public function getListeInfos()
    {
        return $this->listeInfos;
    }

    public function getListeLabel()
    {
        return $this->listeLabel;
    }

    public function getLibelle()
    {
        return $this->getNomClient();
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

    /* Renvoit Vrai si lobjet en paramètre est égal
     * à l'objet appelant
     *
     * @param [type] $obj
     * @return bool
     */
    public function equalsTo($obj)
    {
        return;
    }

    /**
     * Compare l'objet à un autre
     * Renvoi 1 si le 1er est >
     *        0 si ils sont égaux
     *      - 1 si le 1er est <
     *
     * @param [type] $obj1
     * @param [type] $obj2
     * @return Integer
     */
    public function compareTo($obj)
    {
        return;
    }

}
