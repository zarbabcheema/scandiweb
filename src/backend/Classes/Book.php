<?php
namespace MyApp\Classes;
use MyApp\Classes\Product;

// Book class extending Product
class Book extends Product
{
    public function displaySpecialAttribute()
    {
        return "Weight: " . $this->attribute . " KG";
    }
}
