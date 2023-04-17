<?php

namespace MyApp\Database;

use Exception;
use MyApp\Classes\Furniture;
use MyApp\Classes\Types;
use MyApp\Classes\DVD;
use MyApp\Classes\Book;

/**
 * Class Queries
 */
class Queries
{

    private $con;

    function __construct()
    {
        $this->con = new DbConnections();
    }


    private function tableExists($connection, $table)
    {
        $tablesInDb = mysqli_query($connection, 'SHOW TABLES FROM ' . $this->con->getDatabaseName() . ' LIKE "' . $table . '"');
        if ($tablesInDb) {
            if (mysqli_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    /**
     * @throws Exception
     */
    public function getProductsData($connection, $rows = '*', $where = null, $order = null)
    {
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $products = [];
        $q = 'SELECT ' . $rows . ' FROM products';
        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;
        if ($this->tableExists($connection, 'products')) {
            $result = $connection->query($q);
            if ($result) {
                $products = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $product = null;
                        $attribute = $row['attribute'];
                        $type = $row['type'];

                        $classMapping = array(
                            'DVD' => DVD::class,
                            'Book' => Book::class,
                            'Furniture'=>Furniture::class
                        );
                        if (array_key_exists($type, $classMapping)) {
                            $className = $classMapping[$type];
                            $product = new $className($row['id'],$row['sku'], $row['name'], $row['price'] ,$row['type'],$attribute);
                        } else {
                            throw new Exception("Invalid product type: " . $type);
                        }
                        $products[] = $product;
                    }
                }
            }
        }
        return $products;
    }



    public function insert($table, $values, $connection, $rows = null)
    {
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        if ($this->tableExists($connection, $table)) {

            $insert = 'INSERT INTO ' . $table;
            $insert .= '(name,sku,price,type,attribute)';

            $insert .= ' VALUES ("' . $values['name'] . '","' . $values['sku'] . '",' . $values['price'] . ',"' . $values['type'] . '","' . $values['attribute'] . '")';
            $result = $connection->query($insert);
            if ($result) {
                echo 'Success: Product added successfully.';
            } else {
                return " Error inserting record: " . $connection->error;
            }
            return $result;

        }
    }

    public function insertApi($values, $connection, $rows = null)
    {
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $insert = 'INSERT INTO products';
        $insert .= '(name,sku,price,type,attribute)';

        $insert .= ' VALUES ("' . $values->name . '","' . $values->sku . '",' . $values->price . ',"' . $values->type . '","' . $values->attribute . '")';
        $result = $connection->query($insert);
        if ($result) {
            return "Product saved successfully";
        } else {
            return "Error inserting record: " . $connection->error;
        }
    }

    public function delete($connection, $values)
    {
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $delete = 'DELETE FROM products WHERE id in(';
        $i = 1;
        foreach ($values as $val) {

            $delete .= (int)$val;
            if ($i < count($values)) {
                $delete .= ',';
                $i++;
            }

        }
        $delete .= ')';
        $del = $connection->query($delete);
        if ($del) {
            return "product deleted ";
        } else {
            return "Error deleting record: " . $connection->error;
        }
    }

    public function makeConnection()
    {
        return $this->con->connect();
    }

    public function getType($connection, $rows = '*', $where = null, $order = null)
    {
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $type = null;
        $q = 'SELECT ' . $rows . ' FROM type';
        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;
        if ($this->tableExists($connection, 'type')) {
            $result = $connection->query($q);
            if ($result) {
                $arrResult = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($arrResult as $row) {
                    $type[] = new Types($row);
                }
            }
        }
        return $type;
    }

}