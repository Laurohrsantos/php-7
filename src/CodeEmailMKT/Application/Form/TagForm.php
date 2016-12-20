<?php

namespace CodeEmailMKT\Application\Form;

use Zend\Form\Element\{
    Hidden,
    Submit,
    Text
};

use Zend\Form\Form;

class TagForm extends Form
{
    public function __construct($name = 'tag', array $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'id',
            'type' => Hidden::class
        ]);

        $this->add([
            'name' => 'name',
            'type' => Text::class,
            'options' => [
                'label' => 'Nome',
            ],
            'attributes' => [
                'id' => 'name'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'options' => [
                'label' => 'Adicionar',
            ],
            'attributes' => [
                'value' => 'Submit'
            ]
        ]);
    }
}
