<?php
require("../../db/connectDB.php");
require("../../model/ProductController.php");

if (isset($_GET['panino']))
    $panino = $_GET['panino'];
$controller = new ProductController($conn);

if (!empty($_GET['panino'])) {
    $controller->GetProductIngredients($panino);
} else {
    $controller->sendError(array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
}
?>