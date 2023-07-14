<?php

namespace App\Services;

class GenericService
{
    private $request;
    public function __construct($request)
    {
        $this->request = json_decode($request);
    }
    public function request()
    {
        $values = [];

        foreach ($this->request as $value) {
            $values[] =  $value;
        }

        $values = implode("','", $values);

        return $values;
    }
    public function mountedUpdate()
    {
        $fieldsAndValues = '';

        foreach ($this->request as $key => $value) {
            $fieldsAndValues = $fieldsAndValues . $key . " = " . "'$value'" . " , ";
        }

        $values = substr_replace($fieldsAndValues, '', -3, -1);

        return $values;
    }
}
