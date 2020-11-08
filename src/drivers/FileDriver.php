<?php


namespace biscuit\package\drivers;

use biscuit\package\Exceptions\FileDriverDirectoryNotFoundException;
use Illuminate\Support\Facades\File;

class FileDriver extends Driver
{
    public function fetchPosts()
    {
        $files = File::files($this->config['files_path']);

        foreach ($files as $file)
        {
            $this->parse($file->getPathname(),$file->getFilename());
        }

        return $this->posts;
    }

    protected  function validateSource()
    {
        if(! File::exists($this->config['files_path']))
        {
            throw new FileDriverDirectoryNotFoundException(
                'Directory at ' . $this->config['files_path'] . ' is not found ! check the files_path in config file'
            );
        }
    }
}