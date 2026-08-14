<?php

require_once dirname(__DIR__) . "/app/core/SessionManager.php";

SessionManager::init();
require_once dirname(__DIR__) . "/app/core/Database.php";

require_once dirname(__DIR__) . "/app/core/Router.php";