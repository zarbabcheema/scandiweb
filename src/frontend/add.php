<?php

use MyApp\Database\Queries;

require_once __DIR__ . '/../vendor/autoload.php';
?>
<?php
$queries = new Queries();
$connection = $queries->makeConnection();
?>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div>
    <div>
        <h1 class="title">
            Product Add
        </h1>
        <form method="post" id="product_form" class="add-form">

            <div>
                <input type="submit" name="add-form" value="Save" id="save-btn" class="save-button" onclick="saveFormValidation()">
            </div>
            <div>
                <a href="../index.php" class="cancel-button"><i class="fa fa-plus"></i> Cancel </a>
            </div>
            <div>
                <span id="error">Please, fill required fields</span>
            </div>
            <div id="error-result">

            </div>
            <label>
                Sku
                <input aria-label="SKU" id="sku" class="sku" name="sku" required type="text">
            </label>
            <label>
                Name
                <input aria-label="name" id="name" class="name" name="name" required type="text">
            </label>
            <label>
                Price ($)
                <input aria-label="price" id="price" class="price" name="price" required type="number"
                       min="0" oninput="validity.valid||(value='');"                >
            </label>
            <label>
                Type Switcher
                <select aria-label="type"   id="productType" name="type" required
                        onchange="changeAttributes()">
                    <option value=""> Type Switcher</option>
                    <?php
                    $types = $queries->getType($connection);
                    foreach ($types as $type):
                        ?>
                        <option value='<?= $type->getName() ?>'> <?= $type->getName() ?></option>

                    <?php
                    endforeach;
                    ?>
                </select>
            </label>

            <div id="attributesContainer">
                <!-- Special Attributes will be dynamically added here based on the selected type -->
            </div>

        </form>
    </div>
</div>

<script src="js/add.js"></script>
