<?php


namespace biscuit\package\Unit;


use biscuit\package\model\Post;
use biscuit\package\PressFileParser;
use biscuit\package\TestCase;
use Carbon\Carbon;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function get_head_body_test()
    {

        $file = (new PressFileParser(__DIR__ . '/../blog/MarkFile1.md'));
        $data = $file->getRowData();

        $this->assertStringContainsString('title: My Title',$data[1]);
        $this->assertStringContainsString('description: Description here',$data[1]);
        $this->assertStringContainsString('Blog post body here',$data[2]);
    }
    /** @test */
    public function use_input_content_if_file_not_exist()
    {

        $file = (new PressFileParser("---\r\ntitle: My Title\r\ndescription: Description here\r\n---"));
        $data = $file->getData();

        $this->assertStringContainsString('My Title' , $data['title']);
        $this->assertStringContainsString('Description here' , $data['description']);
    }
    /** @test */
    public function separate_head_array()
    {
        $file = (new PressFileParser(__DIR__ . '/../blog/MarkFile1.md'));
        $data = $file->getData();

        $this->assertStringContainsString('My Title',$data['title']);
        $this->assertStringContainsString('Description here',$data['description']);

    }
    /** @test */
    public function get_separated_body_test()
    {
        $file = (new PressFileParser(__DIR__ . '/../blog/MarkFile1.md'));
        $data = $file->getData();

        $this->assertStringContainsString("<h1>heading</h1>\n<p>Blog post body here</p>",$data['body']);
    }
    /** @test */
    public function get_date_as_carbon_test()
    {
        $file = (new PressFileParser("---\r\ndate: May 14, 2020\r\n---"));

        $data = $file->getData();

        $this->assertInstanceOf(Carbon::class,$data['date']);

        $this->assertStringContainsString("05,14,2020",$data['date']->format('m,d,Y'));
    }
    /** @test */
    public function an_extra_field_get_saved()
    {
        $file = (new PressFileParser("---\r\nauthor: Abdelrahman Ibrahim\r\n---"));

        $data = $file->getData();

        $this->assertContains(json_encode(['author'=>'Abdelrahman Ibrahim']),$data);
    }

    /** @test */
    public function test_add_more_than_one_extra_field()
    {
        $file = (new PressFileParser("---\r\nauthor: Abdelrahman Ibrahim\r\nimage: avatar.png\r\n---"));

        $data = $file->getData();

        $this->assertContains(json_encode(['author'=>'Abdelrahman Ibrahim','image'=>'avatar.png']),$data);

    }

}