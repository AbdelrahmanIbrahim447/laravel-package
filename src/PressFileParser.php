<?php


namespace biscuit\package;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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

    public function getData(){
        return $this->data;
    }
    public function getRowData(){
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
        foreach (explode("\r\n",trim($this->rowData[1])) as $string)
        {
            preg_match(
                '/(.*):\s?(.*)/',
                $string,
                $fieldArray
            );
            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
        $this->data['body'] = trim($this->rowData[2]);
    }
    private function processField()
    {
        foreach ($this->data as $field => $value)
        {
            $class = 'biscuit\\package\\fields\\' . ucfirst($field);

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
}