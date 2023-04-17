<?php

use MyApp\Database\Queries;

require_once __DIR__ . '/../../vendor/autoload.php';

$queries = new Queries();
$connection = $queries->makeConnection();

if (isset($_POST) && isset($_POST['pro']) && count($_POST["pro"])>0) {
    $queries->delete( $connection, $_POST['pro']);
}
