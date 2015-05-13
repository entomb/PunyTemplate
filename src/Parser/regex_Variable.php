<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate\Parser;


Class regex_Variable extends regexParser implements iParser{



    var $_opentag   = '/\{(\$[^*\}]+)\}/';


    function apply(&$text){ 

        $text = preg_replace_callback($this->_opentag, 'self::callback_variable', $text);

    }


    function callback_variable($match=null){
        $_inner = $match[1];

        $_allVars = $this->findVars($_inner);
        $result = '<?if(';


        $_first = true;
        foreach($_allVars as $var){
            $result.='isset('.$this->parseVar($var).')';
            if(!$_first){
                $result.=' && ';
            }
            $_first = false;
        }

        $result.= '){ echo (';
        $result.= $this->parseVar($_inner);
        $result.= ');}?>';

        return $result;
        
    }

}
