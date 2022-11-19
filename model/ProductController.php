<?php
require("BaseController.php");
class ProductController extends BaseController 
{
    public function select()
    {
        $this->sendOutput($result, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
    }
}