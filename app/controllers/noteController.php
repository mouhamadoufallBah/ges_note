<?php
require_once PATHBASE . "/app/model/anne.model.php";
require_once PATHBASE . "/app/model/classe.model.php";
require_once PATHBASE . "/app/model/periode.model.php";
require_once PATHBASE . "/app/model/matiere.model.php";
require_once PATHBASE . "/app/model/note.model.php";
function showPage(): void
{
    $userConnected = $_SESSION["userConnect"];
    $anneeScolaire = getCurrentAnne();
    $_SESSION["current_annee"] = $anneeScolaire["id"] ;
    $matieres = getAllMatiere();
    $classes = getAllClasse();
    $periodes = getAllPeriode();
    $moyen = 0;


    $matiere_id = 0;
    $periode_id = 0;
    $classe_id = 0;
    
    $moyen = getMoyenne($classe_id, $matiere_id, $periode_id, $anneeScolaire['id']);
    $eleves = getNote($classe_id, $matiere_id, $periode_id, $anneeScolaire['id']);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $matiere_id = (int)$_POST["matiere"];
        $periode_id = (int)$_POST["periode"];
        $classe_id = (int)$_POST["classe"];
        $anneeScolaireId = $_SESSION['current_annee'];
        $moyen = getMoyenne($classe_id, $matiere_id, $periode_id, $anneeScolaireId);
        $eleves = getNote($classe_id, $matiere_id, $periode_id, $anneeScolaireId);
    }

    require_once(PATHBASE . "/app/view/dashboar.html.php");
}


function updateNote(){
    var_dump($_POST);
    die('update note');
}
