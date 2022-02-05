<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Src\System\DatabaseConnection;

error_reporting(E_ALL);

$dotenv = new DotEnv(__DIR__);
$dotenv->load();
$dbConnection = (new DatabaseConnection())->getConnection();
var_dump($dbConnection);
