<?php

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
    $data = array('name' => $name, 'sku' => $sku, 'price' => $price, 'type' => $type, 'attribute' => $attribute);
    return json_encode([$queries->insert('products', $data, $connection)]);
}

