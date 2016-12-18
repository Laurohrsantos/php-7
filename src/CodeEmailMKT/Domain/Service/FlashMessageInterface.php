<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Service;

interface FlashMessageInterface
{
    const MESSAGE_SUCCESS = 0;

    public function setNamespace(string $name);

    public function setMessage($key, string $value);

    public function getMessage($key);
}