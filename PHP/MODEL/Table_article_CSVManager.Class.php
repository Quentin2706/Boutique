<?php

class Table_article_CSVManager{
    public static function getList()
    {
        $db = DbConnect::getDb();
        $liste = [];
        $q = $db->query("SELECT * FROM table_article_CSV ");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $liste[] = new Table_article_CSV($donnees);
            }
        }
        return $liste;
    }
}

