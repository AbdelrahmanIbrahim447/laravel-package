<?php


namespace biscuit\package\drivers;


use biscuit\package\PressFileParser;
use Illuminate\Support\Str;

abstract class Driver
{
    protected $posts = [];

    protected $config;

    public function __construct()
    {
        $this->setConfig();

        $this->validateSource();
    }

    public abstract function fetchPosts();

    private function setConfig()
    {
        $this->config = config('Press.'.config('Press.driver'));
    }
    
    protected function validateSource()
    {
        return true;
    }

    protected function parse($path,$id)
    {
        $this->posts[] = array_merge(
            (new PressFileParser($path))->getData(),
            [
                'id'    =>  Str::slug($id)
            ]
        );
    }
}