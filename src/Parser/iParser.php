<?php
/**
 * This file is part of the entomb.PunyTemplate
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
namespace entomb\PunyTemplate\Parser;

Interface iParser {

    //public function pre_compile($string);
    public function apply(&$string);
    //public function post_compile($string);

}
 