<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/ENTITES/Utilisateur.php";
class UtilisateurModel {
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getByEmail(string $email):?Utilisateur{
        $sql = "SELECT u.*, r.nomRole FROM utilisateurs u
        INNER JOIN roles r ON u.role_id = r.id
        WHERE email = :email";

        $row = $this->db->executeQuery($sql, ['email' => $email], true);

        if(empty($row)) return null;

        return new Utilisateur(
            (int)$row['id'],
            $row['nom'],
            $row['prenom'],
            $row['email'],
            $row['password'],
            $row['nomrole']
        );
    }
}