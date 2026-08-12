<?php
require_once PATHBASE."/app/core/Database.php";

function getAllClasse(): array{
    $r = getAllData('classes');
    return $r;
}