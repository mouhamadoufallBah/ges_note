<?php

function renderView(string $file, array $data = [])
{
    $viewData = $data;
    require_once(PATHBASE . "/app/view/$file.html.php");
}

function redirectToRoute(string $uri): void
{
    header("Location:" . WEB_ROUTE . "$uri");
}

function renderViewLayout(string $file, string $layout, array $data = []): void
{
    $viewData = $data;
    ob_start();
    require_once(PATHBASE . "/app/view/$file.html.php");

    $contentView = ob_get_clean();

    require_once(PATHBASE . "/app/view/layout/$layout.layout.html.php");
}
