<?php


namespace biscuit\package;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Reflection;
use ReflectionClass;
use ReflectionException;

class PressFileParser
{
    private $filename;
    private $data;
    private $rowData;

    /**
     * PressFileParser constructor.
     * @param $filename
     */
    public function __construct( string $filename)
    {
        $this->filename = $filename;

        $this->splitFile();

        $this->separateHead();

        $this->processField();
    }

    public function getData()
    {
        return $this->data;
    }
    public function getRowData()
    {
        return $this->rowData;
    }
    public function splitFile(){
        $data = File::exists($this->filename) ? File::get($this->filename) : $this->filename ;

        preg_match("/^\-{3}(.*?)\-{3}(.*)/s",
            $data,
            $this->rowData
        );
    }
    private function separateHead()
    {
        foreach (explode("\n",trim($this->rowData[1])) as $string)
        {
            preg_match(
                '/(.*):\s?(.*)/',
                $string,
                $fieldsArray
            );
            $this->data[$fieldsArray[1]] = $fieldsArray[2];
        }
        $this->data['body'] = trim($this->rowData[2]);
    }
    private function processField()
    {
        foreach ($this->data as $field => $value)
        {
            $class = $this->getFields(ucfirst($field));
            if(! class_exists($class) && ! method_exists($class,'process'))
            {
                $class = 'biscuit\\package\\fields\\Extra';
            }
            $this->data = array_merge(
                $this->data,
                $class::process($field,$value,$this->data)
            );
        }
    }

    private function getFields($field)
    {
        foreach (\biscuit\package\facades\Press::getFields() as $avalibleField)
        {
            $class = new ReflectionClass($avalibleField);
            if ($class->getShortName() == $field)
                {
                    return $class->getName();

                }

        }
    }
}