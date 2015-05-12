<?php

namespace entomb\PunyTemplate;

class ViewLoadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PunyTemplate
     */
    protected $skeleton; 


    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new PunyTemplate(array(
                            'BaseDir' => __DIR__.'/Fake',
                            'TemplateDir' => '/views',
                            'CompileDir' => '/compiled',
                        ));
    }


    public function testLoadView()
    {
        //$this->setExpectedException('\entomb\PunyTemplate\Exception\RuntimeException');
        
        $result = $this->skeleton->parse('simple.tpl');


        $this->assertEquals('<h1>simple view</h1>',$result);
    }


}