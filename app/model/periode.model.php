<?php
require_once PATHBASE."/app/core/Database.php";

function getAllPeriode(): array{
    $r = getAllData('periodes');
    return $r;
}