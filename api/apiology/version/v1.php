<?php

namespace Apiology\Apiology\Version;

// Resource / Class
class V1
{

    private $response = array();

    public function __construct()
    {
        return true;
    }

    public function sample($_data){
        // assign resource name to a variable
        $resource = "sample";
        $file = "apiology/version/resources/" .$resource. ".php";
        // require file
        require $file;
        // call by namespace
        $module = "Apiology\\Apiology\\version\\resources\\" .ucfirst($resource). "";
        // instantiate object
        $module = new $module();
        // call method (resource)
        $module->sample($_data);
    }
}
