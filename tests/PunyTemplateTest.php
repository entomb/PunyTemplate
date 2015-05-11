<?php

namespace entomb\PunyTemplate;

class PunyTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PunyTemplate
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new PunyTemplate;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\entomb\PunyTemplate\PunyTemplate', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\LogicException');
        throw new Exception\LogicException;
    }
}
