<?php
class BaseController
{
    /**
     * Send API output.
     *
     * @param mixed  $data
     * @param array[string] $httpHeaders
     */
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        $arr = array();
        while($row = $data->fetch_assoc())
        {
            array_push($arr, $row);
        }
        
        //print_r($data);
        print_r(json_encode($arr, JSON_PRETTY_PRINT));
        exit;
    }
}