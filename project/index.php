<?php

session_start();
define('DS', DIRECTORY_SEPARATOR);
//Include Configuration file
//require dirname(__FILE__,2).DS.'config'.DS.'config.php';

require_once dirname(__FILE__).'/config/config.php';
require_once dirname(__FILE__).'/library/db.php';
require_once dirname(__FILE__).'/library/main.php';

//require_once __DIR__.'/restapi/api.php';
//App::load($_config);