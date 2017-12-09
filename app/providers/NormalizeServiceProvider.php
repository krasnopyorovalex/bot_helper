<?php

namespace App\providers;

use App\normalize\NormalizeData;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class NormalizeServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['normalize'] = function (){
            return new NormalizeData();
        };
    }
}