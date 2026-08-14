<?php

require_once dirname(__DIR__) . "/app/core/SessionManager.php";

Session::init();

require_once dirname(__DIR__) . "/app/core/Database.php";

require_once dirname(__DIR__) . "/app/core/router.php";