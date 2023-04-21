<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../vendor/autoload.php';

use MyApp\Classes\Book;
use MyApp\Classes\DVD;
use MyApp\Classes\Furniture;
use MyApp\Database\Queries;
$queries = new Queries();
$connection = $queries->makeConnection();

$data = json_decode(file_get_contents('php://input'));
if($data){
    $name = $data->name;
    $sku = $data->sku;
    $price = $data->price;
    $type = $data->type;
    $attribute = $data->attribute;

    $product = [];
    $classMapping = array(
        'DVD' => DVD::class,
        'Book' => Book::class,
        'Furniture' => Furniture::class
    );
    if (array_key_exists($type, $classMapping)) {
        $className = $classMapping[$type];
        $product = new $className(null, $sku, $name, $price, $type, $attribute);
    } else {
        throw new Exception("Invalid product type: " . $type);
    }

    echo $queries->insert($product,$connection);
}

?>