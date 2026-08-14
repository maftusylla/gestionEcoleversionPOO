<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/entites/AnneeScolaire.php";
class MatiereModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getParClasse(int $classeId):array{
        $sql = "SELECT m.id, m.nomMatiere
        FROM matiere_classes mc
        INNER JOIN matieres m ON m.id = mc.matiere_id
        WHERE mc.classe_id = :classe_id
        ORDER BY m.nomMatiere";

        $rows = $this->db->executeQuery($sql, ['classe_id' => $classeId], false);

        $matieres = [];
        foreach($rows as $row){
            $matieres[] = new Matiere((int)$row['id'], $row['nommatiere']);
        }
        return $matieres;
    }
}