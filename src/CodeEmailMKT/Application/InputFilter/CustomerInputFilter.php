<?php

namespace CodeEmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class CustomerInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class]
            ]
        ]);

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
    }

}