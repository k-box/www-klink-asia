<?php

use TightenCo\Jigsaw\Jigsaw;
use Dotenv\Dotenv;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->beforeBuild(function (Jigsaw $jigsaw) {
    
    $dotenv = new Dotenv(__DIR__);
    
    $dotenv->load();

    if(is_null($jigsaw->getConfig('klink_token'))){
        $jigsaw->setConfig('klink_token', env('KLINK_TOKEN'));
    }

    if(is_null($jigsaw->getConfig('klink_url'))){
        $jigsaw->setConfig('klink_url', env('KLINK_URL'));
    }

    if($jigsaw->getConfig('production') && is_null($jigsaw->getConfig('baseUrl'))){
        $jigsaw->setConfig('baseUrl', env('APP_URL'));
    }
});

