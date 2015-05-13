<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate;

    
Class ParserHandler{
 
    var $instances = array();

    function __construct($parserList){
        foreach($parserList as $parserName){
            $parserClass = "entomb\\PunyTemplate\\Parser\\$parserName";
            if(class_exists($parserClass)){
                $this->instances[$parserName] = new $parserClass;
            }
        }
    } 

}
