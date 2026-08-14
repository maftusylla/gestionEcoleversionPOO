<?php

class Periode {
    public int $id;
    public string $nomPeriode;

    public function __construct(int $id = 0, string $nomPeriode = ""){
        $this->id = $id;
        $this->nomPeriode = $nomPeriode;
    }

    public function __toString(){
        return $this->nomPeriode;
    }
}