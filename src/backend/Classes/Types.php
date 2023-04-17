<?php

namespace MyApp\Classes;
class Types
{
    private $id;
    private $name;

    public function __construct($row)
    {
        $this->id=$row['id'];
        $this->name=$row['name'];
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}