<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerCreatePageAction
{
    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;


    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router
    )
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $form = new CustomerForm();

        $flash = $request->getAttribute('flash');
        if ($request->getMethod() == 'POST'){
            $data = $request->getParsedBody();

            $entity = new Customer();
            $entity->setName($data['name']);
            $entity->setEmail($data['email']);

            $this->repository->create($entity);
            $flash->setMessage('success', 'Contato cadastrado com sucesso.');

            $uri = $this->router->generateUri('customer.list');

            return new RedirectResponse($uri);
        }

        return new HtmlResponse($this->template->render('app::customer/create', [
            'form' => $form
        ]));
    }
}