<?php

namespace biscuit\package\fields;

use Carbon\Carbon;

class Date extends FieldContract
{
    public static function process($field,$value,$data)
    {
            return [
                $field => Carbon::parse($value)
            ];
    }
}