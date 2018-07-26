<?php

namespace Davislar\Payments\Config;

use Davislar\Payments\Exceptions\ParamsException;
use Davislar\Payments\Interfaces\ConfigInterface;
use Davislar\Payments\PayPal\PayPalController;

class Config
{
    /**
     * @var ConfigInterface
     */
    protected static $paymentConfig;


    /**
     * @param $type
     * @param array $config
     * @return bool
     * @throws \Davislar\Payments\Exceptions\ParamsException
     */
    public static function setConfig($type, array $config){
        switch ($type){
            case ConfigInterface::TYPE_PAY_PAL:{
                self::$paymentConfig = new PayPalConfig($config);
                break;
            }
        }
        return true;
    }

    /**
     * @throws ParamsException
     */
    public static function getConfig($name = null){
        if (is_null(self::$paymentConfig)){
            throw new ParamsException("Not set config");
        }
        if (!is_null($name)){
            return self::$paymentConfig->$name;
        }
        return self::$paymentConfig;
    }
}