<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate\Parser;


Class regex_Foreach extends regexParser implements iParser{


    var $_opentag   = "/(\{foreach ([^*\}]+)\})/i";

    var $_midtag    = "/\{foreachelse\}/i";

    var $_closetag  = "/\{\/foreach\}/i";


    function apply(&$text){
        
        $text = preg_replace_callback($this->_opentag, 'self::callback_open', $text);
        $text = preg_replace_callback($this->_midtag, 'self::callback_mid', $text);
        $text = preg_replace_callback($this->_closetag, 'self::callback_close_double', $text);

    }


    function callback_open($match=null){
        $_inner  = explode('as',$match[2]);
        $_arrVar = $this->findFirstVar($match[2]); 

        return  "<?if(isset(".$this->parseVar($_arrVar).")){ foreach(".$this->parseVar($_inner[0]).(isset($_inner[1])?' as '.$_inner[1]:' as $item')."){?>";
    }


    function callback_mid($match=null){
        return '<?}}else{{?>';
    }




}
