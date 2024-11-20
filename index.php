<?php
require 'vendor/autoload.php';

use alejandro\core\Request;
use alejandro\core\App;
use alejandro\app\exceptions\AppException;

try {
    require_once __DIR__ . '/core/Bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
} catch (AppException $appException) {
    $appException->handleError();
}
