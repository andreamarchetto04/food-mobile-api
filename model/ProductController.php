<?php
require("BaseController.php");
class ProductController extends BaseController
{
    public function GetArchiveProduct() //mostra tutti i prodotti

    {
        $sql = "select distinct p.ID, p.name, p.price
                from product p
                order by p.ID;";

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function CheckIngredient() //Mostro ingredienti disponibili e loro quantità

    {
        $sql = "select distinct i.name, i.available_quantity
                from ingredient i
                where i.active = 1
                order by i.ID;";

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function CheckProduct() //Mostro prodotti disponibili e loro quantità

    {
        /*$sql = "select distinct p.name, p.quantity, nv.kcal
                from product p
                left join nutritional_value nv on nv.ID= p.nutritional_value_ID
                where p.active = 1;";*/

                $sql = "select distinct p.name, p.quantity, nv.kcal
                from product p
                left join nutritional_value nv on nv.ID= p.nutritional_value_ID
                where p.active=1;";

        /*$sql = "select distinct p.name, p.quantity
        from product p
        order by p.ID;";*/

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function DeleteIngredient($ingredient_ID) //Non mostra l'ingrediente finito di cui gli si passa l'id--in fase di progettazione

    {
        //delete from ingredient WHERE  ID= '$ingredient_ID';---query per eliminare record ma non si può usare causa FOREIGN KEY
        /*$sql = "select distinct i.name, i.available_quantity
        from ingredient i
        where i.ID<" . $ingredient_ID . " or i.ID>" . $ingredient_ID . ";";
        */

        $sql = "update ingredient i
                set i.active = 0
                where i.ID=" . $ingredient_ID . ";";
        $result = $this->conn->query($sql);
        $this->CheckIngredient();
    }
    public function DeleteProduct($product_ID)
    {
        $sql = "update product p
                set p.active = 0
                where p.ID = " . $product_ID . ";";

        $result = $this->conn->query($sql);
        $nRows = mysqli_affected_rows($this->conn); //ottiene il numero di righe cambiato dopo una query
        $this->SendState($result, JSON_OK);
        $this->CheckProduct();
        
    }
    public function GetArchiveIngredients($product_ID)
    {
        $sql = "select i.name, pi2.ingredient_quantity, i.available_quantity, i.description
                from product p
                left join product_ingredient pi2 on p.ID = pi2.product_ID
                left join ingredient i on i.ID = pi2.ingredient_ID
                left join category c on c.ID = p.category_ID
                where p.ID = " . $product_ID . " and c.name = 'panino' or c.name = 'piadina';";

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function setIngredient($name, $description, $avariable_quantity)
    {
        $sql = "insert into ingredient(name, description, available_quantity)
        values
        (" . $name . "," . $description . "," . $avariable_quantity . ");";

        $result = $this->conn->query($sql);
        $this->CheckIngredient();
    }
    public function setProduct($name, $price, $description, $quantity, $category_ID, $nutritional_value_ID)
    {
        $sql = "insert into product(name, price, description, quantity, category_ID, nutritional_value_ID)
                values
                (" . $name . ", " . $price . ", " . $description . ", " . $quantity . ", " . $category_ID . ", " . $nutritional_value_ID . ");";

        $result = $this->conn->query($sql);
        $this->CheckProduct();
    }
    public function AddIngredient($ingredient)
    {
        $sql = "insert into ingredient(name, description, available_quantity)
        values
        (" . $ingredient["name"] . "," . $ingredient["description"] . "," . $ingredient["available_quantity"] . ")";

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function AddProduct($product)
    {
        //insert into product(name, price, description, quantity, category_ID, nutritional_value_ID)
        $sql = "insert into product(name, price, description, quantity, category_ID, nutritional_value_ID)
                values
                (" . $product["name"] . ", " . $product["price"] . ", " . $product["description"] . ", " . $product["quantity"] . ", " . $product["category_ID"] . ", " . $product["nutritional_value_ID"] . ");";

        $result = $this->conn->query($sql);
        $this->SendOutput($result, JSON_OK);
    }
    public function ReActiveProduct($product_ID)
    {
        $sql = "update product p
                set p.active = 1
                where p.ID = " . $product_ID . ";";

        $result = $this->conn->query($sql);
        $nRows = mysqli_affected_rows($this->conn);
        $this->SendState($result, JSON_OK);
    }
}