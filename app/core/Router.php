<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/models/UtilisateurModel.php";

class AuthController {
    private UtilisateurModel $utilisateurModel;

    public function __construct(){
        $db = new Database();
        $this->utilisateurModel = new UtilisateurModel($db);
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $utilisateur = $this->utilisateurModel->getByEmail($email);

            if($utilisateur !== null && $password == $utilisateur->password){
                set_session("connexion", [
                    'id' => $utilisateur->id,
                    'nom' => $utilisateur->nom,
                    'prenom' => $utilisateur->prenom,
                    'email' => $utilisateur->email,
                    'role' => $utilisateur->role
                ]);
                header("Location:http://localhost:8000/");
                exit;
            }

            header("Location:http://localhost:8000/login");
            exit;
        }
        require_once dirname(__DIR__) . "/views/connexion.html.php";
    }

    public function logout(){
        destroy_session();
        header("Location:http://localhost:8000/login");
        exit;
    }
}