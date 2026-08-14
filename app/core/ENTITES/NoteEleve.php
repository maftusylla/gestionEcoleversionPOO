<?php
require_once __DIR__ . "/Eleve.php";
require_once __DIR__ . "/Evaluation.php";

class NoteEleve {
    public Eleve $eleve;
    public Evaluation $evaluation;

    public function __construct(Eleve $eleve, Evaluation $evaluation){
        $this->eleve = $eleve;
        $this->evaluation = $evaluation;
    }

    public function moyenne():float{
        return $this->evaluation->moyenne();
    }

    public function appreciation():string{
        $moy = $this->moyenne();
        if($moy>=16) return 'Très bien';
        if($moy>=14) return 'Bien';
        if($moy>=12) return 'Assez bien';
        if($moy>=10) return 'Passable';
        return 'Insuffisant';
    }
}