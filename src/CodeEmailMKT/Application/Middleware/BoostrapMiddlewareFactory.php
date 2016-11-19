<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use CodeEmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;


class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bootstrap = new Bootstrap();
        $flash = $container->get(FlashMessageInterface::class);

        return new BootstrapMiddleware($bootstrap, $flash);
    }
}
