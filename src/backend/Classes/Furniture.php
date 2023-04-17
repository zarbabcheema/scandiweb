<?php
namespace MyApp\Classes;
use MyApp\Classes\Product;

// Furniture class extending Product
class Furniture extends Product
{
    public function displaySpecialAttribute()
    {
        return "Dimension: " . $this->attribute ;
    }
}
