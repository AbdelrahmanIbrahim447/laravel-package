<?php


namespace biscuit\package\console;

use biscuit\package\facades\Press;
use biscuit\package\model\Post;
use biscuit\package\Repositories\PostRepositories;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'update blog post';

    public function handle(PostRepositories $postRepositories)
    {
        if(Press::configNotPublished())
        {
            return $this->warn('Please publish the config by running this command \'php artisan vendor:publish --tag=press-config\' ');
        }

        try{
            $posts = Press::dirver()->fetchPosts();

            $this->info('Number of posts is ' . count($posts) );

            foreach ($posts as $post)
            {
                $postRepositories->handle($post);
                $this->info('Post ' . $post['title'] . ' inserted successfully');
            }

        }catch (Exception $exception)
        {
            return $this->error($exception->getMessage());
        }
    }
}