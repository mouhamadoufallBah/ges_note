<?php

require_once PATHBASE."/app/core/Database.php";

function findUserByEmail(string $email): array{
    $db = connexionDB();
    $sql = "select u.*, r.* from utilisateurs u inner join roles r on r.id = u.role_id where email = :email";
    $user = executeQuery($db, $sql, ['email' => $email]);
    return $user;
}