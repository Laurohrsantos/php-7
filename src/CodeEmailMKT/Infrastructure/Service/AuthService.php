<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Service\AuthInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;
use CodeEmailMKT\Domain\Entity\User;

class AuthService implements AuthInterface
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {

        $this->authenticationService = $authenticationService;
    }

    public function authenticate(String $email, String $password) : bool
    {
        /** @var ValidatableAdapterInterface $adapter */
        $adapter = $this->authenticationService->getAdapter();
        $adapter->setIdentity($email);
        $adapter->setCredential($password);

        $result = $this->authenticationService->authenticate();

        return $result->isValid();
    }

    public function isAuth() : bool
    {
        return $this->getUser() != null;
    }

    public function getUser() : User
    {
        return $this->authenticationService->getIdentity();
    }

    public function destroy()
    {
        $this->authenticationService->clearIdentity();
    }
}