<?php
require("../../db/connectDB.php");
require("../../model/ProductController.php");

$panino = $_GET["panino"];
$controller = new ProductController($conn);

if ($panino) {
    $controller->GetProductIngredients($panino);
} else {
    $controller->sendError(array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
}
?>