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



    public function testCompile()
    {
        
        $result = $this->skeleton->parse('simple_compile.tpl');
        $expected = ('<h1></h1><b>notdefined</b><b>notdefined</b><b>notdefined</b>');

        $this->assertEquals($expected,_minify($result));
        


        $result = $this->skeleton->parse('simple_compile.tpl',array('anArray'=>array(1,2,3)));
        $expected = ('<h1></h1><b>1</b> <b>2</b> <b>3</b><b>notdefined</b><b>notdefined</b>');

        $this->assertEquals($expected,_minify($result));


        $result = $this->skeleton->parse('simple_single_var.tpl',array('single'=>'one'));
        $expected = '<h1>one</h1>';

        $result = $this->skeleton->parse('simple_single_var.tpl',array('single'=>null));
        $expected = '<h1></h1>';

        $result = $this->skeleton->parse('simple_single_var.tpl',array());
        $expected = '<h1></h1>';

        $this->assertEquals($expected,_minify($result));



    }


}