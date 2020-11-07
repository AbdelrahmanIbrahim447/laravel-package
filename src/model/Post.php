<?php


namespace biscuit\package\model;


use biscuit\package\database\factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    use  HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}