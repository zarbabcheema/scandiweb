<?php

use MyApp\Database\Queries;

require_once __DIR__ . '/../vendor/autoload.php';
?>
<?php
$queries = new Queries();
$connection = $queries->makeConnection();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css"/>

<div class="container mt-4">
    <div>
        <h1 class="title">Product List</h1>
        <a href="frontend/add.php" class="add-button"><i class="fa fa-plus"></i> ADD </a>
        <form method="post" id="del-pro">
            <input class="del-button" name="delete" id="delete" value="MASS DELETE" type="submit">
            <div class="row">
                <?php

                $products = $queries->getProductsData($connection);

                // Display product details
                foreach ($products as $product) { ?>
                <div class="column">
                    <div class="card">
                        <input type="checkbox" class="delete-checkbox" name="pro[]" value="<?= $product->getId() ?>">
                        <h4><b><?= $product->getSku(); ?></b></h4>
                        <h4><b><?= $product->getName(); ?></b></h4>
                        <h4><b><?= $product->getPrice() . " $"; ?></b></h4>
                        <h4><b><?= $product->displaySpecialAttribute() ?></b></h4>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>
        </form>

    </div>
</div>
<script src="frontend/js/delete.js"></script>
