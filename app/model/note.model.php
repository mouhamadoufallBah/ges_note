<?php

function getMoyenne(int $classeId, int $matiereId, int $periodeId, int $annescolaireId): float
{
    $pdo = connexionDB();
    $sql = "SELECT ROUND(COALESCE(AVG(moyenne_eleve), 0), 2) AS moyenne_general
            FROM 
                (SELECT ev.inscription_id,
                        ROUND(AVG((COALESCE(ev.devoir_1, 0)+ COALESCE(ev.devoir_2, 0)+ 2 * COALESCE(ev.composition, 0)) / 4),2) AS moyenne_eleve
                FROM evaluations ev INNER JOIN inscriptions i ON i.id = ev.inscription_id
                WHERE i.classe_id = :classeId
                AND i.annee_scolaire_id = $annescolaireId
                AND ev.matiere_id = :matiereId
                AND ev.periode_id = :periodeId
                GROUP BY ev.inscription_id)
            AS moyenneClasse";

    $result = executeQuery($pdo, $sql, [
        "classeId" => $classeId,
        "matiereId" => $matiereId,
        "periodeId" => $periodeId,
    ]);

    return (float)$result["moyenne_general"];
}

function getNote(int $classeId, int $matiereId, int $periodeId, int $annescolaireId): array
{
    $pdo = connexionDB();
    $sql = "SELECT 
        i.id as inscription_id, ev.id as evaluation_id, 
        e.id as eleve_id,
        e.nom || ' ' || e.prenom as nom_complet, 
        e.matricule,
        COALESCE(ev.devoir_1, 0) as devoir_1, 
        COALESCE(ev.devoir_2, 0) as devoir_2, 
        COALESCE(ev.composition, 0) as composition,
        ROUND(AVG((COALESCE(ev.devoir_1, 0) + COALESCE(ev.devoir_2, 0) + 2 * COALESCE(ev.composition, 0)) / 4), 2) AS moyenne_eleve,
        CASE
            WHEN ROUND(AVG((COALESCE(ev.devoir_1, 0) + COALESCE(ev.devoir_2, 0) + 2 * COALESCE(ev.composition, 0)) / 4), 2) < 10 THEN 'Insuffisant'
            WHEN ROUND(AVG((COALESCE(ev.devoir_1, 0) + COALESCE(ev.devoir_2, 0) + 2 * COALESCE(ev.composition, 0)) / 4), 2) BETWEEN 10 AND 12 THEN 'Passable'
            WHEN ROUND(AVG((COALESCE(ev.devoir_1, 0)+ COALESCE(ev.devoir_2, 0) + 2 * COALESCE(ev.composition, 0)) / 4), 2) BETWEEN 12.01 AND 14 THEN 'Assez bien'
            WHEN ROUND(AVG((COALESCE(ev.devoir_1, 0)+ COALESCE(ev.devoir_2, 0)+ 2 * COALESCE(ev.composition, 0)) / 4), 2) BETWEEN 14.01 AND 16 THEN 'Bien'
            WHEN ROUND(AVG((COALESCE(ev.devoir_1, 0) + COALESCE(ev.devoir_2, 0) + 2 * COALESCE(ev.composition, 0)) / 4), 2) > 16 THEN 'Très bien'
        END as appreciation
        FROM  inscriptions i
        INNER JOIN eleves e ON e.id = i.eleve_id
        left JOIN evaluations ev ON i.id = ev.inscription_id  AND ev.matiere_id = :matiereId
        AND ev.periode_id = :periodeId
        WHERE i.classe_id = :classeId
        AND i.annee_scolaire_id = :annescolaireId
        GROUP BY ev.id, e.nom, e.prenom, ev.devoir_1, ev.devoir_2, ev.composition, e.id, e.matricule, i.id";

    $result = executeQuery($pdo, $sql, [
        "classeId" => $classeId,
        "matiereId" => $matiereId,
        "periodeId" => $periodeId,
        "annescolaireId" => $annescolaireId
    ], false);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    // die;


    return $result;
}
