<?php
class BaseController
{
    public $conn;
    function __construct($connection)
    {
        $this->conn = $connection;
    }
    /**
     * Send API output.
     *
     * @param mixed  $data
     * @param array[string] $httpHeaders
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        $arr = array();
        while ($row = $data->fetch_assoc()) {
            array_push($arr, $row);
        }
        //formattazione carina da vedere
        print_r(json_encode($arr, JSON_PRETTY_PRINT));
        //formattazione normale
        //print_r(json_encode($arr));
        exit;
    }
    public function sendError($httpHeaders = array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        $err = "parametri non corretti";
        //formattazione carina da vedere
        print_r(json_encode($err, JSON_PRETTY_PRINT));
        //formattazione normale
        //print_r(json_encode($arr));
        exit;
    }
}