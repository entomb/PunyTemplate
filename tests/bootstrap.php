<?php 
/** @var $loader \Composer\Autoload\ClassLoader */
$loader = require dirname(__DIR__) . '/vendor/autoload.php';

echo "Removing pre-compiled caches\n";
foreach (glob(__DIR__.'/Fake/compiled/*.php') as $filename) {
   unlink($filename);
}

/**
  * @helper  
  * whitespace remover 
*/
function _minify($str){
    return preg_replace('/[\s]{2}/i', '', $str);
}