<?php

use MyApp\Classes\Book;
use MyApp\Classes\DVD;
use MyApp\Classes\Furniture;
use MyApp\Database\Queries;

require_once __DIR__ . '/../../vendor/autoload.php';

$queries = new Queries();
$connection = $queries->makeConnection();

if (isset($_POST)) {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    if (!empty($_POST['size'])) {
        $attribute = $_POST['size'];
    } elseif (!empty($_POST['weight'])) {
        $attribute = $_POST['weight'];
    } else {
        $attribute = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
    }
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
    return json_encode([$queries->insert( $product, $connection)]);
}

