<?php

namespace entomb\PunyTemplate;

class ClassSetupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PunyTemplate
     */
    protected $skeleton; 

    public function testNoConfig()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\RuntimeException');
        
        $this->skeleton = new PunyTemplate();
    }


    public function testSameDir()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\LogicException');

        $this->skeleton = new PunyTemplate(array(
                            'BaseDir' => __DIR__.'/Fake',
                            'TemplateDir' => '/does_not_exist',
                            'CompileDir' => '/does_not_exist',
                        ));
    }


    public function testBadTplDir()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\RuntimeException');

        $this->skeleton = new PunyTemplate(array(
                            'BaseDir' => __DIR__.'/Fake',
                            'TemplateDir' => '/does_not_exist',
                            'CompileDir' => '/does_not_exist_either',
                        ));
    }

    
    public function testBadCompileDir()
    {
        $this->setExpectedException('\entomb\PunyTemplate\Exception\RuntimeException');

        $this->skeleton = new PunyTemplate(array(
                            'BaseDir' => __DIR__.'/Fake',
                            'TemplateDir' => '/views',
                            'CompileDir' => '/does_not_exist',
                        ));
    }

    public function testGoodConfigs()
    { 
        $this->skeleton = new PunyTemplate(array(
                            'BaseDir' => __DIR__.'/Fake',
                            'TemplateDir' => '/views',
                            'CompileDir' => '/compiled',
                        ));

        $this->assertEquals($this->skeleton->baseDir(), __DIR__.'/Fake','good base dir');
        $this->assertEquals($this->skeleton->tplDir(), __DIR__.'/Fake/views','good template dir');
        $this->assertEquals($this->skeleton->compileDir(), __DIR__.'/Fake/compiled','good compile dir');

    }

}
