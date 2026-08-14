<?php

class Classe {
    public int $id;
    public string $nomClasse;

    public function __construct(int $id = 0, string $nomClasse = ""){
        $this->id = $id;
        $this->nomClasse = $nomClasse;
    }

    public function __toString(){
        return $this->nomClasse;
    }
}