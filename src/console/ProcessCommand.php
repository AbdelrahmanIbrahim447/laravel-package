<?php


namespace biscuit\package\console;

use biscuit\package\model\Post;
use biscuit\package\PressFileParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'update blog post';

    public function handle()
    {
        $files = File::files('blogs');
        foreach ($files as $file)
        {
            $post = (new PressFileParser($file->getPathname()))->getData();
            Post::create([
                'identifier'    =>  Str::random(),
                'slug'    =>  Str::slug($post['title']),
                'title'    =>  $post['title'],
                'body'    =>  $post['body'],
                'extra'    =>  $post['extra'] ?? [],
            ]);
        }
    }
}