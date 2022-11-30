<?php
require("../../db/connectDB.php");
require("../../model/ProductController.php");

if (isset($_GET["product"]))
    $product = $_GET["product"];

$controller = new ProductController($conn);

if (strlen($product) > 2)
    $controller->GetArchiveProducts($product);
else
    $controller->SendError(JSON_OK);
?>