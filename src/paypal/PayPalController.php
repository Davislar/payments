<?php

namespace Davislar\Payments\PayPal;


use Davislar\Payments\Config\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\PrepareBodyMiddleware;
use GuzzleHttp\Psr7\Request;

class PayPalController
{
    public $token;

    /**
     * @return mixed
     * @throws \Davislar\Payments\Exceptions\ParamsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(){
        if (is_null($this->token)){
            $response = $this->oauthPayPal();
            $this->token = $response->token_type . ' ' . $response->access_token;
        }
        return $this->token;
    }

    /**
     * @return mixed
     * @throws \Davislar\Payments\Exceptions\ParamsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function oauthPayPal(){

        $url = (Config::getConfig('dev')) ? Config::getConfig('url_sandbox') : Config::getConfig('url');
        $client = new Client([
            'auth' => [Config::getConfig('oauth_username'), Config::getConfig('oauth_password')],
        ]);
            $response = $client->request(
                'POST',
            $url . Config::getConfig('oauth_url_v1'),
                [
                    'form_params' => [
                        'grant_type' => 'client_credentials'
                    ]
                ]
            );
        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }
}