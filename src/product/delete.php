<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../vendor/autoload.php';

use MyApp\Database\Queries;
$queries = new Queries();
$connection = $queries->makeConnection();


$data = json_decode(file_get_contents("php://input"));
$ids=[];
foreach ($data->id as $id)
{
    $ids[] = $id;
}

echo  $queries->delete($connection,$ids);

?>