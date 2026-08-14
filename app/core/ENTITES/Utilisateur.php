<?php

class Utilisateur {
    public int $id;
    public string $nom;
    public string $prenom;
    public string $email;
    public string $password;
    public string $role;

    public function __construct(int $id = 0, string $nom = "", string $prenom = "", string $email = "", string $password = "", string $role = ""){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function __toString(){
        return $this->prenom." ".$this->nom." (".$this->role.")";
    }
}