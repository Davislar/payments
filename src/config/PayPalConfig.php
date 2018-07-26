<?php

namespace Davislar\Payments\Config;



use Davislar\Payments\Interfaces\ConfigInterface;
use Davislar\Payments\Exceptions\ParamsException;

class PayPalConfig implements ConfigInterface
{

    protected $dev = true;
    protected $url = 'https://api.paypal.com';
    protected $url_sandbox = 'https://api.sandbox.paypal.com';
    protected $oauth_url_v1 = '/v1/oauth2/token';
    protected $oauth_username;
    protected $oauth_password;

    /**
     * PayPalConfig constructor.
     * @param array $config
     * @throws ParamsException
     */
    public function __construct(array $config)
    {
        foreach ($config as $key => $value){
            if (!property_exists($this, $key)){
                throw new ParamsException("Undefined property " . $key);
            }
            $this->$key = $value;
        }
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
     * @return bool
     */
    public function isDev()
    {
        return $this->dev;
    }

    /**
     * @param bool $dev
     */
    public function setDev($dev)
    {
        $this->dev = $dev;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrlSandbox()
    {
        return $this->url_sandbox;
    }

    /**
     * @param string $url_sandbox
     */
    public function setUrlSandbox($url_sandbox)
    {
        $this->url_sandbox = $url_sandbox;
    }

    /**
     * @return string
     */
    public function getOauthUrlV1()
    {
        return $this->oauth_url_v1;
    }

    /**
     * @param string $oauth_url_v1
     */
    public function setOauthUrlV1($oauth_url_v1)
    {
        $this->oauth_url_v1 = $oauth_url_v1;
    }

    /**
     * @return mixed
     * @throws ParamsException
     */
    public function getOauthUsername()
    {
        if (is_null($this->oauth_username)){
            throw new ParamsException("Not set property oauth_username");
        }
        return $this->oauth_username;
    }

    /**
     * @param mixed $oauth_username
     */
    public function setOauthUsername($oauth_username)
    {
        $this->oauth_username = $oauth_username;
    }

    /**
     * @return mixed
     * @throws ParamsException
     */
    public function getOauthPassword()
    {
        if (is_null($this->oauth_password)){
            throw new ParamsException("Not set property oauth_password");
        }
        return $this->oauth_password;
    }

    /**
     * @param mixed $oauth_password
     */
    public function setOauthPassword($oauth_password)
    {
        $this->oauth_password = $oauth_password;
    }


}