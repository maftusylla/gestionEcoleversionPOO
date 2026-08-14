<?php

class Evaluation {
    public int $inscriptionId;
    public int $matiereId;
    public int $periodeId;
    public ?float $devoir1;
    public ?float $devoir2;
    public ?float $composition;

    public function __construct(int $inscriptionId = 0, int $matiereId = 0, int $periodeId = 0, ?float $devoir1 = null, ?float $devoir2 = null, ?float $composition = null){
        $this->inscriptionId = $inscriptionId;
        $this->matiereId = $matiereId;
        $this->periodeId = $periodeId;
        $this->devoir1 = $devoir1;
        $this->devoir2 = $devoir2;
        $this->composition = $composition;
    }

    public function moyenne():float{
        $d1 = $this->devoir1 ?? 0;
        $d2 = $this->devoir2 ?? 0;
        $comp = $this->composition ?? 0;
        return round(($d1 + $d2 + 2*$comp) / 4, 2);
    }

    public function aDesNotes():bool{
        return $this->devoir1 !== null || $this->devoir2 !== null || $this->composition !== null;
    }
}