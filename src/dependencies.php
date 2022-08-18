<?php

use ApiChannel\common\Constant;
use ApiChannel\dto\web\builder\WebResponseBuilder;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    /**********************************************************************************
     ******************************* View Config DI ***********************************
     *********************************************************************************/

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog and set rotate every 1 days
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        $logger->pushHandler(new \Monolog\Handler\RotatingFileHandler($settings['path'], 1, $settings['level']));
        return $logger;
    };

    // errorLog and set rotate every 1 days
    $container['errorLog'] = function ($c) {
        $settings = $c->get('settings')['errorLog'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        $logger->pushHandler(new \Monolog\Handler\RotatingFileHandler($settings['path'], 1, $settings['level']));
        return $logger;
    };

    /**********************************************************************************
     ****************************** SLIM 3 Config DI **********************************
     *********************************************************************************/

    // Override Slim Error Handler
    $container["errorHandler"] = function ($c){
        return function (Request $request, Response $response, Exception $error) use ($c) {

            $errorResponse = (new WebResponseBuilder())
                ->setStatus(Constant::HTTP_500_VAL)
                ->setMessage(Constant::HTTP_500_NAME)
                ->build();

            return $response
                ->withStatus($errorResponse->getStatus())
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($errorResponse, JSON_PRETTY_PRINT));
        };
    };

    // Override PHP Error Handler
    $container["phpErrorHandler"] = function ($c){
        return function (Request $request, Response $response, $error) use ($c) {

            $errorResponse = (new WebResponseBuilder())
                ->setStatus(Constant::HTTP_500_VAL)
                ->setMessage(Constant::HTTP_500_NAME)
                ->build();

            return $response
                ->withStatus($errorResponse->getStatus())
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($errorResponse, JSON_PRETTY_PRINT));
        };
    };

    // Override Not Found
    $container['notFoundHandler'] = function ($c) {
        return function (Request $request, Response $response) use ($c) {

            $errorDetail = array(
                'error_detail' => array(
                    'path' => $request->getUri()->getPath()
                )
            );

            $errorResponse = (new WebResponseBuilder())
                ->setStatus(Constant::HTTP_404_VAL)
                ->setMessage(json_encode($errorDetail)." not found in handler")
                ->build();

            return $response->withStatus($errorResponse->getStatus())
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($errorResponse, JSON_PRETTY_PRINT));
        };
    };

    // Override Not Allowed
    $container['notAllowedHandler'] = function ($c) {
        return function (Request $request, Response $response, array $methods) use ($c) {

            $errorDetail = array(
                'error_detail' => array(
                    'received-method' => $request->getMethod(),
                    'allowed-method' => implode(', ', $methods)
                )
            );

            $errorResponse = (new WebResponseBuilder())
                ->setStatus(Constant::HTTP_405_VAL)
                ->setMessage(json_encode($errorDetail))
                ->build();

            return $response->withStatus($errorResponse->getStatus())
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($errorResponse, JSON_PRETTY_PRINT));
        };
    };


    /**********************************************************************************
     ******************************* DATABASE & CONFIG DI *****************************
     *********************************************************************************/


    /**********************************************************************************
     ***************************** Non Configuration DI *******************************
     *********************************************************************************/

    
};
