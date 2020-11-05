<?php


namespace biscuit\package\fields;


class Extra extends FieldContract
{
    public static function process($field , $value,$data){
        $extra = isset($data['extra']) ? json_decode($data['extra'],true) : [];
        return [
            'extra' => json_encode(array_merge($extra,[
                $field  =>  $value
            ])),
        ];
    }
}