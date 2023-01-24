<?php

use App\Routing;
use Symfony\Component\ErrorHandler\Debug;
use RedBeanPHP\R;

require_once __DIR__ . '/../vendor/autoload.php';
require '../Routing.php';
session_start();

R::setup('mysql:host=localhost;dbname=admin_page', 'dev', 'dev');

Debug::enable();
Routing::route();