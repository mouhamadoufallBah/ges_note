<?php
require_once PATHBASE."/app/core/Database.php";

function getAllMatiere(): array{
    $r = getAllData('matieres');
    return $r;
}