<?php
namespace MyApp\Classes;
use MyApp\Classes\Product;

// DVD class extending Product
class DVD extends Product
{
    public function displaySpecialAttribute()
    {
        return "Size: " . $this->attribute . " MB";
    }
}
