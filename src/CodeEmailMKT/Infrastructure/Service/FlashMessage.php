<?php

namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class FlashMessage implements FlashMessageInterface
{

    /**
     * @var FlashMessenger
     */
    private $flashMessenger;

    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    public function setNamespace(string $name = __NAMESPACE__) : FlashMessage
    {
        $this->flashMessenger->setNamespace($name);
        return $this;
    }

    public function setMessage($key, String $value) : FlashMessage
    {
        switch ($key){
            case self::MESSAGE_SUCCESS:
                $this->flashMessenger->addSuccessMessage($value);
                break;
        }

        return $this;
    }

    public function getMessage($key)
    {
        $result = null;

        switch ($key){
            case self::MESSAGE_SUCCESS:
                $result = $this->flashMessenger->getCurrentSuccessMessages();
                break;
        }

        return count($result) ? $result[0] : null;
    }
}