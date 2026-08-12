<?php
require_once PATHBASE . "/app/model/user.model.php";

function login(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = findUserByEmail($email);

        if (!empty($user) && $user["mot_de_passe"] == $password) {
            $_SESSION['userConnect'] = $user;
            header("Location: http://localhost:8000");
            exit;
        }
    }

    require_once(PATHBASE . "/app/view/login.html.php");
}

function logout(): void
{
    removeData('KEY_USERCONNECT');
    header("Location: http://localhost:8000/login");
    exit;
}
