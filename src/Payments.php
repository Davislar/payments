<?php

namespace Davislar\Payments;


use Davislar\Payments\Config\Config;
use Davislar\Payments\Exceptions\ParamsException;
use Davislar\Payments\Interfaces\ConfigInterface;
use Davislar\Payments\PayPal\PayPalController;

class Payments
{
    protected $payment;
    /**
     * Payments constructor.
     * @param $type
     * @param array $config
     * @throws Exceptions\ParamsException
     */
    public function __construct($type, array $config)
    {
        Config::setConfig($type, $config);
        switch ($type){
            case ConfigInterface::TYPE_PAY_PAL:{
                $this->payment = new PayPalController();
                break;
            }
            default:{
                throw new ParamsException("Undefined type " . (string)$type);
            }
        }
        return true;
    }
    public function __get($name) {
        if (!property_exists($this, $name)){
            throw new ParamsException("Undefined property " . $name);
        }
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        return $this->$name;
    }


    /**
     * @return PayPalController
     */
    public function getPayment()
    {
        return $this->payment;
    }

}