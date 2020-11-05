<?php


namespace biscuit\package\fields;


abstract class FieldContract
{
    public static function process($fieldType,$fieldValue,$data)
    {
        return [
            $fieldType  =>  $fieldValue
        ];
    }
}