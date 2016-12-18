<?php

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\Factory\CustomerFormFactory;
use CodeEmailMKT\Application\Form\Factory\LoginFormFactory;
use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory;
use Zend\Form\ConfigProvider;
use Zend\Stdlib\ArrayUtils;
use Zend\View\Helper\Service\IdentityFactory;
use Zend\View\HelperPluginManager;

$forms = [
    'dependencies' => [
        'alias' => [],
        'invokables' => [],
        'factories' => [
            HelperPluginManager::class => HelperPluginManagerFactory::class,
            CustomerForm::class => CustomerFormFactory::class,
            LoginForm::class => LoginFormFactory::class,
        ]
    ],
    'view_helpers' => [
        'alias' => [],
        'invokables' => [],
        'factories' => [
            'identity' => IdentityFactory::class
        ]
    ]
];

$configProviderForm = (new ConfigProvider())->__invoke();

return ArrayUtils::merge($configProviderForm, $forms);
