<?php


namespace biscuit\package\model;


use biscuit\package\database\factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    use  HasFactory;

    protected $guarded = [];

    public function extra($field)
    {
        return optional(json_decode($this->extra))->$field;
    }
    protected static function newFactory()
    {
        return PostFactory::new();
    }
}