<?php

use CodeEmailMKT\Application\Form\{
    CustomerForm, Factory\CustomerFormFactory, Factory\LoginFormFactory, LoginForm
};
use CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View;

$forms = [
    'dependencies' => [
        'alias' => [],
        'invokables' => [],
        'factories' => [
            View\HelperPluginManager::class => HelperPluginManagerFactory::class,
            CustomerForm::class => CustomerFormFactory::class,
            LoginForm::class => LoginFormFactory::class,
        ]
    ],
    'view_helpers' => [
        'alias' => [],
        'invokables' => [],
        'factories' => [
            'identity' => View\Helper\Service\IdentityFactory::class
        ]
    ]
];

$configProviderForm = (new ConfigProvider())->__invoke();

return ArrayUtils::merge($configProviderForm, $forms);
