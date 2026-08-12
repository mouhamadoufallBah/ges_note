<?php

require_once PATHBASE."/app/core/Database.php";

function getCurrentAnne(): array{
    $db = connexionDB();
    $sql = "SELECT * FROM annees_scolaires where est_active = :est_active";
    $currentAnne = executeQuery($db, $sql, ['est_active' => true]);
    return $currentAnne;
}