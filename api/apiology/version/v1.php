<?php

namespace Apiology\Apiology\Version;

// Headers Class
use Apiology\Apiology\classes\http as HTTP;

// Resource / Class
class V1
{

    private $response = array();

    public function __construct()
    {
        return true;
    }

    public function sample($_data){
        // Instance the HTTP object
        $this->http_response = new HTTP();
        $file = "apiology/version/resources/sample.php";
        // require file
        require $file;
        // call by namespace
        $module = "Apiology\\Apiology\\version\\resources\\Sample";
        // instantiate object
        $module = new $module();
        // call method (resource)
        $module->sample($_data);
    }
}
