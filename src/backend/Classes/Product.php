<?php

namespace MyApp\Classes;

// Abstract class for Product
abstract class Product
{
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $attribute;

    public function __construct($id,$sku, $name, $price,$type, $attribute)
    {
        $this->id=$id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type=$type;
        $this->attribute = $attribute;
    }

    abstract public function displaySpecialAttribute();
    // Methods
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

}

