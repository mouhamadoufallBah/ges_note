<?php

function asset(string $path): void{
     echo WEB_ROUTE."/asset/$path";
}

function showProfil(): array{
    $userConnect = getData(KEY_USERCONNECT);
    return $userConnect;
}

function showUrlProfilPhoto(): void{
    $userConnect = getData(KEY_USERCONNECT);
    echo $userConnect["photo"];
}

function pathUrl(string $uri = ""){
    echo WEB_ROUTE."/$uri";
}