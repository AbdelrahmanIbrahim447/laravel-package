<?php

namespace biscuit\package\fields;

use biscuit\package\MarkdownParser;

class Body extends FieldContract
{
    public static function process($field,$value,$data)
    {
        return [
            $field  =>  MarkdownParser::parse($value)
        ];
    }
}