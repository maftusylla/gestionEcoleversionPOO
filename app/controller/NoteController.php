<?php
require_once dirname(__DIR__) . "/core/Database.php";
require_once dirname(__DIR__) . "/models/ClasseModel.php";
require_once dirname(__DIR__) . "/models/PeriodeModel.php";
require_once dirname(__DIR__) . "/models/MatiereModel.php";
require_once dirname(__DIR__) . "/models/AnneeScolaireModel.php";
require_once dirname(__DIR__) . "/models/EvaluationModel.php";
require_once dirname(__DIR__) . "/entites/Utilisateur.php";

class NoteController {
    private ClasseModel $classeModel;
    private PeriodeModel $periodeModel;
    private MatiereModel $matiereModel;
    private AnneeScolaireModel $anneeScolaireModel;
    private EvaluationModel $evaluationModel;

    public function __construct(){
        $db = new Database();
        $this->classeModel = new ClasseModel($db);
        $this->periodeModel = new PeriodeModel($db);
        $this->matiereModel = new MatiereModel($db);
        $this->anneeScolaireModel = new AnneeScolaireModel($db);
        $this->evaluationModel = new EvaluationModel($db);
    }

    public function getTable(){

        $sessionData = Session::get("connexion");
        if(!$sessionData){
            header("Location:http://localhost:8000/login");
            exit;
        }
        $utilisateur = new Utilisateur(
            $sessionData['id'],
            $sessionData['nom'],
            $sessionData['prenom'],
            $sessionData['email'],
            '',
            $sessionData['role']
        );

        $classes = $this->classeModel->getAll();
        $periodes = $this->periodeModel->getAll();
        $anneeActive = $this->anneeScolaireModel->getActive();

        $classe_id = $_POST['classe'] ?? null;
        $matieres = $classe_id ? $this->matiereModel->getParClasse((int)$classe_id) : [];

        $matiere_id = $_POST['matiere'] ?? ($matieres[0]->id ?? null);
        $periode_id = $_POST['periode'] ?? ($periodes[0]->id ?? null);

        $moyenne = 0;
        $eleves = [];

        if($classe_id && $matiere_id && $periode_id){
            $moyenne = $this->evaluationModel->getMoyenneClasse((int)$classe_id, (int)$matiere_id, (int)$periode_id);
            $eleves = $this->evaluationModel->getListeNotes((int)$classe_id, (int)$matiere_id, (int)$periode_id);
        }

        require_once dirname(__DIR__) . "/views/note.html.php";
    }
}