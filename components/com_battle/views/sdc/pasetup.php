<?php
//setup everything.
session_start();
define('ADVENGAME_ROOT', __DIR__);
if(basename(dirname($_SERVER['PHP_SELF']))==='designer') {
    define('ADVENGAME_URL', dirname(dirname($_SERVER['PHP_SELF'])));
} else {
    define('ADVENGAME_URL', dirname($_SERVER['PHP_SELF']));
}

spl_autoload_register(function ($class) {
    $classInfo = explode('\\',$class);
    if(array_shift($classInfo) !== 'sdcAdventure') {return;}
    $cls = array_pop($classInfo);
    $ns = implode('/',$classInfo);
    if(!$ns || !$cls) {return;}
    $path = __DIR__."/classes/{$ns}/{$cls}.class.php";
    if(is_readable($path)) { include $path; }
});
