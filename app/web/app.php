<?php

//ini_set('display_errors', 0);

use Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/config.php';

$app['debug'] = true;

$app->run();
