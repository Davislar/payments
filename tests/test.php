<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using

use \Davislar\Payments\Payments;
use \Davislar\Payments\Interfaces\ConfigInterface;


$app = new Payments(
    ConfigInterface::TYPE_PAY_PAL,
    [
        'oauth_username' => 'AQuL-GzNpXcUGq1trAGPA4sWJW57Tveyw-Wc-nvAG6YumXIJh4rltMkthcae6ctJc8nCulsnxjf0PRQS',
        'oauth_password' => 'EJqOhEsQoI_QhzLhVoBUlUcIPra0BtF_o-7uPItHxUXnpaG4ONuP5b8_lQ3ehtgmB2Ezh3T5ZKD2QUPX'
    ]
    );
$app->payment->getToken();
var_dump($app->payment->token);
