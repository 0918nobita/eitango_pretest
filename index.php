<?php
namespace Pretest;

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = new \Pretest\Dispatcher();
$dispatcher->dispatch();
