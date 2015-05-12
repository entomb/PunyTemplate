<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate;

class View {


    private $conf_TemplateFile = null;
    private $conf_CompiledFile = null;

    private $_RAW      = '';
    private $_COMPILED = '';
    private $_RESULT = '';

    function __construct($filepath=null){
        $this->load($filepath);
    }


    public function load($filepath=null){
        if($filepath && is_readable($filepath)){
            $this->conf_TemplateFile = $filepath;
        }else{
            throw new Exception\RuntimeException('File path ' . $filepath . ' is not a valid file');
        }

        $this->_RAW = file_get_contents($this->conf_TemplateFile);


        return $this;
    }

    public function compile($compileDir){

        if($compileDir && is_writable($compileDir)){
            $this->conf_CompiledFile = $compileDir . DIRECTORY_SEPARATOR . md5($this->conf_TemplateFile).'.puny.php';
        }else{
            throw new Exception\RuntimeException('Not a valid $compileDir');
        }



        if(is_readable($this->conf_CompiledFile)){
            return $this;
        }







        $buffer = fopen($this->conf_CompiledFile, "w");
        fwrite($buffer, $this->_RAW); 
        fclose($buffer);

        return $this;
    }

    public function parse($data=null){
        if(is_array($data)){
            extract($data, EXTR_OVERWRITE);
        }

        ob_start();
        include $this->conf_CompiledFile;
        $this->_RESULT = ob_get_clean();

        return $this->_RESULT;
    }

}