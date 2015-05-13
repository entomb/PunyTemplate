<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate;
use entomb\PunyTemplate\View as View;
use entomb\PunyTemplate\Parser as Parser;

class PunyTemplate {


    private $conf_BaseDir     ='';
    private $conf_TemplateDir ='/views';
    private $conf_CompileDir  ='/tmp/punytpl';
    private $conf_ParserList  = Array('regex_Foreach','regex_If','regex_Variable');


    function __construct($config=null){

        if(isset($config['TemplateDir'])){
            $this->conf_TemplateDir = $config['TemplateDir'];
        }

        if(isset($config['CompileDir'])){
            $this->conf_CompileDir = $config['CompileDir'];
        }

        if(isset($config['BaseDir'])){
            $this->conf_BaseDir = $config['BaseDir'];
        }

        if($this->conf_TemplateDir == $this->conf_CompileDir){
            throw new Exception\LogicException('TemplateDir and CompileDir can not be the same');
        }

        //check stuff
        if(!is_dir($this->tplDir())){
            throw new Exception\RuntimeException('File path ' . $this->tplDir() . ' is not a valid directory');
        }

        if(!is_writable($this->compileDir())){
            throw new Exception\RuntimeException('File path ' . $this->compileDir() . ' is either not valid or not writable');
        }


        $this->Parser = new ParserHandler($this->conf_ParserList);
    }
    


    public function tplDir(){
        return $this->conf_BaseDir.$this->conf_TemplateDir;
    }

    public function compileDir(){
        return $this->conf_BaseDir.$this->conf_CompileDir;
    }

    public function baseDir(){
        return $this->conf_BaseDir;
    }




    public function parse($template,$data=null){

        $view = new View($this->tplDir().DIRECTORY_SEPARATOR.$template);
        
        //inject parsers
        $view->Parser = &$this->Parser;

        //compile it
        $view->compile($this->compileDir());

        //parse the data
        return $view->parse($data);
    }

}
