<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/entites/Periode.php";

class PeriodeModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getAll():array{
        $rows = $this->db->getAllTables('periodes');
        $periodes = [];
        foreach($rows as $row){
            $periodes[] = new Periode((int)$row['id'], $row['nomperiode']);
        }
        return $periodes;
    }
}
class PeriodeModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getAll():array{
        $rows = $this->db->getAllTables('periodes');
        $periodes = [];
        foreach($rows as $row){
            $periodes[] = new Periode((int)$row['id'], $row['nomperiode']);
        }
        return $periodes;
    }
}