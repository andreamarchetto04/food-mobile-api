<?php
require("db/connectDB.php");
require("model/BaseController.php");

$sql = "
select distinct p.ID, p.name, p.price
from product p
order by p.ID;
";

$result = $conn->query($sql);
$conn->close();

$controller = new BaseController();
$controller->sendOutput($result, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
?>