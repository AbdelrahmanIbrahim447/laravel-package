<?php


namespace biscuit\package;

use Parsedown;

class MarkdownParser
{
    public static function parse(string $string) : string
    {
        return Parsedown::instance()->text($string);
        
    }
}