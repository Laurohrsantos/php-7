<?php

use CodeEmailMKT\Application\Action\Customer\{
    CustomerListPageAction, CustomerCreatePageAction, CustomerUpdatePageAction, CustomerDeletePageAction
};
use CodeEmailMKT\Application\Action\Tag\{
    TagListPageAction, TagCreatePageAction, TagUpdatePageAction, TagDeletePageAction
};
use CodeEmailMKT\Application\Action\Campaign\{
    CampaignListPageAction, CampaignCreatePageAction, CampaignUpdatePageAction, CampaignDeletePageAction, CampaignSenderPageAction, CampaignReportPageAction
};
use CodeEmailMKT\Application\Action\Customer\Factory as Customer;
use CodeEmailMKT\Application\Action\Tag\Factory as Tag;
use CodeEmailMKT\Application\Action\Campaign\Factory as Campaign;
use CodeEmailMKT\Application\Action;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            Action\HomePageAction::class => Action\HomePageFactory::class,
            Action\TestePageAction::class => Action\TestePageFactory::class,
            Action\LoginPageAction::class => Action\LoginPageFactory::class,
            Action\LogoutAction::class => Action\LogoutFactory::class,

            CustomerListPageAction::class => Customer\CustomerListPageFactory::class,
            CustomerCreatePageAction::class => Customer\CustomerCreatePageFactory::class,
            CustomerUpdatePageAction::class => Customer\CustomerUpdatePageFactory::class,
            CustomerDeletePageAction::class => Customer\CustomerDeletePageFactory::class,

            TagListPageAction::class => Tag\TagListPageFactory::class,
            TagCreatePageAction::class => Tag\TagCreatePageFactory::class,
            TagUpdatePageAction::class => Tag\TagUpdatePageFactory::class,
            TagDeletePageAction::class => Tag\TagDeletePageFactory::class,

            CampaignListPageAction::class => Campaign\CampaignListPageFactory::class,
            CampaignCreatePageAction::class => Campaign\CampaignCreatePageFactory::class,
            CampaignUpdatePageAction::class => Campaign\CampaignUpdatePageFactory::class,
            CampaignDeletePageAction::class => Campaign\CampaignDeletePageFactory::class,
            CampaignSenderPageAction::class => Campaign\CampaignSenderPageFactory::class,
            CampaignReportPageAction::class => Campaign\CampaignReportPageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => CodeEmailMKT\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => CodeEmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => CodeEmailMKT\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'auth.login',
            'path' => '/auth/login',
            'middleware' => CodeEmailMKT\Application\Action\LoginPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'auth.logout',
            'path' => '/auth/logout',
            'middleware' => CodeEmailMKT\Application\Action\LogoutAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.list',
            'path' => '/admin/customers',
            'middleware' => CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.create',
            'path' => '/admin/customers/create',
            'middleware' => CustomerCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'customer.update',
            'path' => '/admin/customers/update/{id}',
            'middleware' => CustomerUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'customer.delete',
            'path' => '/admin/customers/{id}/delete',
            'middleware' => CustomerDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'tag.list',
            'path' => '/admin/tags',
            'middleware' => TagListPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'tag.create',
            'path' => '/admin/tag/create',
            'middleware' => TagCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST']
        ],
        [
            'name' => 'tag.update',
            'path' => '/admin/tag/update/{id}',
            'middleware' => TagUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options' => [
                'tokens' => ['id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'tag.delete',
            'path' => '/admin/tags/{id}/delete',
            'middleware' => TagDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.list',
            'path' => '/admin/campaign',
            'middleware' => CampaignListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'campaign.create',
            'path' => '/admin/campaign/create',
            'middleware' => CampaignCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST']
        ],
        [
            'name' => 'campaign.update',
            'path' => '/admin/campaign/update/{id}',
            'middleware' => CampaignUpdatePageAction::class,
            'allowed_methods' => ['GET', 'PUT'],
            'options' => [
                'tokens' => ['id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.delete',
            'path' => '/admin/campaign/{id}/delete',
            'middleware' => CampaignDeletePageAction::class,
            'allowed_methods' => ['GET', 'DELETE'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.sender',
            'path' => '/admin/campaign/sender/{id}',
            'middleware' => CampaignSenderPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
        [
            'name' => 'campaign.report',
            'path' => '/admin/campaigns/report/{id}',
            'middleware' => CampaignReportPageAction::class,
            'allowed_methods' => ['GET'],
            'options' => [
                'tokens' => [
                    'id' => '\d+'
                ]
            ]
        ],
    ],
];
