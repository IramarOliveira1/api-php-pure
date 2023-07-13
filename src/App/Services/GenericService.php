<?php

namespace App\Services;

class GenericService
{
    public static function request($request)
    {
        $values = [];

        foreach (json_decode($request) as $value) {
            $values[] =  $value;
        }

        $values = implode("','", $values);

        return $values;
    }
}
