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
$arr = array();

while($row = $result->fetch_assoc())
{
    array_push($arr, $row);
    //$arr[] = $row;
}

//print_r($arr);

$prova = new BaseController();
$prova->sendOutput($arr, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
?>