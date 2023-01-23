<?php

use App\Routing;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__ . '/../vendor/autoload.php';
require '../Routing.php';

Debug::enable();
Routing::route();