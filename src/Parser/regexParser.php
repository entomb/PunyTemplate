<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate\Parser;


Class regexParser {
    
    /*
        TODO: Parse variables

        $cenas.coisa becomes $cenas['coisa']
        $cenas.coisa.outra becomes $cenas['coisa']['outra']
        $cenas[$coisa.cenas] becomes $cenas[$coise['cenas']]
        $cenas[0] stays $cenas[0]
        

        TODO: extract pipes
        
        $cenas|func becomes func($cenas);
        $cenas.coisa|func becomes func($cenas['coisa']);
        $cenas.coisa|func:'a':'b' becomes func($cenas['coisa'],'a','b');

    */

    //var $_varRule = '/\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\.]*)/';
    var $_varRule = '/\$[^*\s\+\=\-\*\/\&\{\}\>\<\)\(]+/';

    function findFirstVar($str){
        preg_match($this->_varRule, $str, $_vars);
        if(isset($_vars[0])){
            return $_vars[0];
        }
    }

    function findVars($str){
        preg_match_all($this->_varRule, $str, $_vars);
        if(isset($_vars[0])){
            return $_vars[0];
        }
    }

    function parseVar($str){

        $parts = explode(".", $str);
        if(count($parts)===1){
            return trim($str);
        }

        $result = trim(array_shift($parts));
        foreach($parts as $part){
            $result.="['".trim($part)."']";
        }
        
        return $result;
    }


    function callback_close($match=null){
        return '<?}?>';
    }
    
    function callback_close_double($match=null){
        return '<?}}?>';
    }
     
 
}
 