<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Service;

interface FlashMessageInterface
{
    const MESSAGE_SUCCESS = 0;

    public function setNamespace($name);

    public function setMessage($key, $value);

    public function getMessage($key);
}