<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Service;

use CodeEmailMKT\Domain\Entity\User;

interface AuthInterface
{
    public function authenticate($email, $password);

    public function isAuth();

    public function getUser();

    public function destroy();
}