<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../vendor/autoload.php';

use MyApp\Database\Queries;

$queries = new Queries();
$connection = $queries->makeConnection();

if(isset($_GET['sku'])){
    $items=$queries->getProductsData($connection,'*','sku LIKE "'.$_GET['sku'] .'"');
}
else{
    $items=$queries->getProductsData($connection);
}

if($items){

    $productArray = array();
    $productArray["body"] = array();
    $productArray["itemCount"] = sizeof($items);
    foreach ($items as $item) {
        $pro = array(
            "id" => $item->getId(),
            "name" => $item->getName(),
            "sku" => $item->getSku(),
            "price" => $item->getPrice(),
            "type" => $item->getType(),
            "attribute" => $item->displaySpecialAttribute()
        );
        $productArray["body"][] = $pro;
    }
    echo json_encode($productArray);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>