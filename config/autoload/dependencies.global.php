<?php
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\TagRepositoryFactory;
use CodeEmailMKT\Infrastructure\Service;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;
use CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\CustomerRepositoryFactory;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use CodeEmailMKT\Infrastructure\Service\FlashMessageFactory;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            CustomerRepositoryInterface::class => CustomerRepositoryFactory::class,
            TagRepositoryInterface::class => TagRepositoryFactory::class,
            FlashMessageInterface::class => FlashMessageFactory::class,
            'doctrine:fixture_cmd:load' => \CodeEdu\FixtureFactory::class,
            \CodeEmailMKT\Domain\Service\AuthInterface::class => Service\AuthServiceFactory::class,
        ],
        'aliases' => [
            'Configuration' => 'config', //Doctrine needs a service called Configuration
            'Config' => 'config', //Doctrine needs a service called Configuration
            \Zend\Authentication\AuthenticationService::class => 'doctrine.authenticationservice.orm_default',
        ],
    ],
];
