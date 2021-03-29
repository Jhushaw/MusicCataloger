<?php
namespace App\Http\Services\Utility;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyLogger implements ILogger
{
    
    private static $logger =null;
    
    
    public static function getLogger()
    {
        if(self::$logger == null)
        {
            self::$logger = new Logger('playlaravel');
            self::$logger->pushHandler(new StreamHandler('php://stderr',Logger::DEBUG));
        }
        return self::$logger;
    }
    
    public static function debug($message, $data=array())
    {
        self::getLogger()->addDebug($message,$data);
    }
    
    public static function warning($message, $data=array())
    {
        self::getLogger()->addWarning($message,$data);
    }
    
    public static function error($message, $data=array())
    {
        self::getLogger()->addError($message,$data);
    }
    
    public static function info($message, $data=array())
    {
        self::getLogger()->addInfo($message,$data);
    }
    
    
}