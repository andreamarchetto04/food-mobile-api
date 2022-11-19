<?php
require("db/connectDB.php");
require("model/BaseController.php");

$sql = "
select i.name, pi2.ingredient_quantity, i.available_quantity, i.description
from product p
left join product_ingredient pi2 on p.ID = pi2.product_ID
left join ingredient i on i.ID = pi2.ingredient_ID
where p.name = 'panino proteico';
";

$result = $conn->query($sql);
$conn->close();

$controller = new ProductController();
?>