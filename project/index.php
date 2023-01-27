<?php

/* Load external routes file */
require_once 'config/db.php';
require_once 'vendor/autoload.php';
require_once 'routes/routes.php';
require_once 'autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::start();
