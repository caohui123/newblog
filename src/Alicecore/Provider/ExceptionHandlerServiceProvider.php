<?php

namespace Alicecore\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Alicecore\Handle\ExceptionHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExceptionHandlerServiceProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['exception_handler'] = function ($app) {
            return new ExceptionHandler($app['debug']);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(Container $app, EventDispatcherInterface $dispatcher)
    {
        if (isset($app['exception_handler'])) {
            $dispatcher->addSubscriber($app['exception_handler']);
        }
    }
}
