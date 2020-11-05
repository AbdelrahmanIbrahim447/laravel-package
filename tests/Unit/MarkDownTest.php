<?php

namespace biscuit\package\Unit;


use biscuit\package\MarkdownParser;
use biscuit\package\TestCase;


class MarkDownTest extends TestCase
{
    /** @test */
    public function Parse_Test(){
        $this->assertEquals('<h1>heading test</h1>',MarkdownParser::parse('# heading test'));
    }
}