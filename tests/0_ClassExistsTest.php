<?php

namespace entomb\PunyTemplate;

class ClassExistsTest extends \PHPUnit_Framework_TestCase
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
                            'TemplateDir' => '/compiled',
                            'CompileDir' => '/views',
                        ));
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\entomb\PunyTemplate\PunyTemplate', $actual);
    }

    public function testLogicException()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\LogicException');
        throw new Exception\LogicException;
    }
    
    public function testRuntimeException()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\RuntimeException');
        throw new Exception\RuntimeException;
    }

}
