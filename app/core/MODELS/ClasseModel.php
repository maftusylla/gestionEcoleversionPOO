<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/ENTITES/Classe.php";

class ClasseModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getAll():array{
        $rows = $this->db->getAllTables('classes');
        $classes = [];
        foreach($rows as $row){
            $classes[] = new Classe((int)$row['id'], $row['nomclasse']);
        }
        return $classes;
    }
}