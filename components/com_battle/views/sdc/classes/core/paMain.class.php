<?php
/**
 *
 */
namespace sdcAdventure\core;

class paMain {
    /**
     * Load the requested class and call the 'call' method
     * @param $args The arguments to be passed to the method (typically $_POST, $_GET or a combination of the two)
     * @returns array Contains success flag, and either results array from 'call', or error message and error data for failure.
     */
    public static function call($args) {
        $paOutput = array();
        try {
            $paObj = self::loadClass($args);
            if(!($paObj instanceof paBase)) { throw new paException("Invalid class ".str_replace('\\sdcAdventure\\','',$paClass)." specified"); }
            $paObj->populateArgs($args);
            $paOutput = array('success'=>true, 'results'=>$paObj->call());
        } catch(paException $px) {
            $paOutput = array('success'=>false, 'error'=>$px->getMessage(), 'errorData'=>$px->getErrorData());
        }
        return $paOutput;
    }

    /**
     * @todo: I guess this could/should be an autoload method.
     * @param array $args
     * @return \sdcAdventure\core\paBase
     * @throws paException 
     */
    private static function loadClass($args) {
        $classInfo = array(
            'nspace' => (isset($args['lib'])?$args['lib']:'game'),
            'className' => (isset($args['module'])?$args['module']:'default'),
        );
        $classInfo['fullClassName'] = "\\sdcAdventure\\{$classInfo['nspace']}\\{$classInfo['className']}";
        $classInfo['classPath'] = dirname(__DIR__)."/{$classInfo['nspace']}/{$classInfo['className']}.class.php";
        if($classInfo['nspace']==='core' || preg_match('/[^\w\\\\]/',$classInfo['fullClassName'])) {
            throw new paException("Illegal class specified");
        }
        if(!is_readable($classInfo['classPath'])) {throw new paException('Unknown class specified',$classInfo);}
        require_once($classInfo['classPath']);
        return new $classInfo['fullClassName']();
    }
}
