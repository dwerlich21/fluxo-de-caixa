<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require 'bootstrap.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();

foreach (glob(__DIR__ . '/routes/*.php') as $filename) {
    require $filename;
}

$app->run();

