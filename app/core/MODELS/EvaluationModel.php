<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/ENTITES/NoteEleve.php";

class EvaluationModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getMoyenneClasse(int $classeId, int $matiereId, int $periodeId):float{
        $sql = "SELECT ROUND(COALESCE(AVG(moyenne_eleve),0),2) AS moyenne_general
        FROM (
            SELECT inscription_id,
            ROUND(AVG((COALESCE(devoir1,0)+COALESCE(devoir2,0)+2*COALESCE(composition,0))/4),2) AS moyenne_eleve
            FROM evaluations ev
            INNER JOIN inscriptions i ON i.id = ev.inscription_id
            INNER JOIN anneeScolaires a ON a.id = i.annee_id
            WHERE
            i.classe_id = :classe_id
            AND ev.matiere_id = :matiere_id
            AND ev.periode_id = :periode_id
            AND a.actif = 1
            AND (devoir1 IS NOT NULL OR devoir2 IS NOT NULL OR composition IS NOT NULL)
            GROUP BY inscription_id
        ) sub";

        $result = $this->db->executeQuery($sql, [
            'classe_id' => $classeId,
            'matiere_id' => $matiereId,
            'periode_id' => $periodeId,
        ], true);

        return (float)($result['moyenne_general'] ?? 0);
    }

    public function getListeNotes(int $classeId, int $matiereId, int $periodeId):array{
        $sql = "SELECT i.id AS inscription_id, e.id AS eleve_id, e.nom, e.prenom, e.matricule,
               ev.devoir1, ev.devoir2, ev.composition
        FROM inscriptions i
        INNER JOIN eleves e ON e.id = i.eleve_id
        INNER JOIN anneeScolaires a ON a.id = i.annee_id
        LEFT JOIN evaluations ev ON ev.inscription_id = i.id
            AND ev.matiere_id = :matiere_id
            AND ev.periode_id = :periode_id
        WHERE i.classe_id = :classe_id
        AND a.actif = 1
        ORDER BY e.nom, e.prenom";

        $rows = $this->db->executeQuery($sql, [
            'classe_id' => $classeId,
            'matiere_id' => $matiereId,
            'periode_id' => $periodeId,
        ], false);

        $liste = [];
        foreach($rows as $row){
            $eleve = new Eleve((int)$row['eleve_id'], $row['nom'], $row['prenom'], $row['matricule']);

            $devoir1 = $row['devoir1'] !== null ? (float)$row['devoir1'] : null;
            $devoir2 = $row['devoir2'] !== null ? (float)$row['devoir2'] : null;
            $composition = $row['composition'] !== null ? (float)$row['composition'] : null;

            $evaluation = new Evaluation((int)$row['inscription_id'], $matiereId, $periodeId, $devoir1, $devoir2, $composition);

            $liste[] = new NoteEleve($eleve, $evaluation);
        }
        return $liste;
    }
}