<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Cliente;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Entity\Endereco;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
{
    private $template;
    /**
     * @var EntityManager
     */
    private $manager;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customer = new Customer();
        $customer->setName("Lauro Henrique");
        $customer->setEmail("henrique_rodrigues_s@yahoo.com.br");

        $this->repository->create($customer);

        //$categorias = $this->manager->getRepository(Category::class)->findAll();

        return new HtmlResponse($this->template->render("app::teste", [
            'data' => 'dados passados para o template',
            'categorias' => []
        ]));
    }
}
