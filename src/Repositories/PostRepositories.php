<?php


namespace biscuit\package\Repositories;


use biscuit\package\model\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostRepositories
{
    public function handle($post)
    {
        Post::updateOrcreate([
            'identifier'    => $post['id'],
        ],[
            'slug'    =>  Str::slug($post['title']),
            'title'    =>  $post['title'],
            'body'    =>  $post['body'],
            'extra'    =>  $this->extra($post),
        ]);

    }

    private function extra( $post )
    {
        $extra = json_decode($post['extra'] ?? [],true) ;

        $attribute = Arr::except($post,['title','body','id','extra']);

        return json_encode(array_merge($extra,$attribute));
    }
}