<?php

namespace App\providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\telegram\TelegramApi;

class TelegramServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['telegram'] = $app->factory(function (){
            return new TelegramApi;
        });
    }
}