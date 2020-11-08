<?php


namespace biscuit\package;


use Illuminate\Support\Str;

class Press
{
    protected $fields = [];

    public function configNotPublished()
    {
        return is_null(config('Press'));
    }
    public function dirver()
    {
        $driver = Str::ucfirst(config('Press.driver'));
        $class = 'biscuit\\package\\drivers\\'  .   $driver . 'Driver';

        return new $class;
    }
    public  function path()
    {
        return config('Press.path','admin');
    }

    public function fields($fields)
    {
        $this->fields = array_merge($this->fields,$fields);
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }


}