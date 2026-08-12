<?php
define('PATHBASE',dirname(__DIR__));
require_once(PATHBASE."/app/core/Database.php");
require_once PATHBASE."/app/core/Debug.php";
require_once PATHBASE."/app/core/Model.php";
require_once(PATHBASE."/app/core/Helpers.php");


require_once PATHBASE."/app/core/SessionManager.php";
sessionStart();
require_once PATHBASE."/app/core/Router.php";


