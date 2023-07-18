<?php

namespace App\Services;

class GenericService
{
    public $request;
    public function __construct($request)
    {
        $this->request = json_decode($request);
    }
    public function request($request)
    {
        $values = [];

        foreach ($request as $value) {
            $values[] = $value;
        }

        $filter = array_filter($values);

        $values = implode("','", $filter);

        return $values;
    }
    public function mountedUpdate($request)
    {
        $fieldsAndValues = '';

        foreach ($request as $key => $value) {
            $fieldsAndValues = $fieldsAndValues . $key . " = " . "'$value'" . " , ";
        }

        $values = substr_replace($fieldsAndValues, '', -3, -1);

        return $values;
    }
}
