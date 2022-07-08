<?php


namespace Database\Seeders;


class CustomSeeder
{
    protected function addValueToArrayIfNotNull(array &$arr, string $name, $value)
    {
        if (isset($value) && $value != null) {
            $arr[$name] = $value;
        }
    }

}
