<?php

namespace CodeEmailMKT\Application\Form;

use CodeEmailMKT\Domain\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Element\{
    Hidden, Submit, Text, Textarea
};

use Zend\Form\Form;

class CampaignForm extends Form implements ObjectManagerAwareInterface
{
    private $objectManager;

    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
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
            'name' => 'subject',
            'type' => Text::class,
            'options' => [
                'label' => 'Assunto',
            ],
            'attributes' => [
                'id' => 'subject'
            ]
        ]);

        $this->add([
            'name' => 'tags',
            'type' => ObjectSelect::class,
            'attributes' => [
                'multiple' => 'multiple'
            ],
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class' => Tag::class,
                'property' => 'name',
                'label' => 'Tags'
            ]
        ]);

        $this->add([
            'name' => 'template',
            'type' => Textarea::class,
            'options' => [
                'label' => 'Template'
            ],
            'attributes' => [
                'id' => 'template'
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

    /**
     * Set the object manager
     *
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Get the object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager() : ObjectManager
    {
        return $this->objectManager;
    }
}
