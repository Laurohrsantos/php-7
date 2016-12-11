<?php

namespace CodeEmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class LoginInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo é obrigatório.'
                        ]
                    ]
                ],
                [
                    'name' => EmailAddress::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            EmailAddress::INVALID => 'Este e-mail não é válido.',
                            EmailAddress::INVALID_FORMAT => 'Este e-mail não é válido.',
                            EmailAddress::INVALID_HOSTNAME => "'%hostname%' não é válido como um hostname.",
                        ]
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Este campo é obrigatório.'
                        ]
                    ]
                ]
            ]
        ]);
    }

}