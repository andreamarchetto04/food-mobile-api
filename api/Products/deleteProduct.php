<?php
require("../../db/connectDB.php");
require("../../model/ProductController.php");

if (isset($_GET["panino"]))
    $panino = $_GET["panino"];

$controller = new ProductController($conn);

if (strlen($panino) > 2)
    $controller->DeleteProduct($panino);
else
    $controller->SendError(JSON_OK);
?>