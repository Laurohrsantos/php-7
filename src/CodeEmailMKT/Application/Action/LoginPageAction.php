<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class LoginPageAction
{
    private $router;

    private $template;
    /**
     * @var LoginForm
     */
    private $form;
    /**
     * @var AuthInterface
     */
    private $authService;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template,
        LoginForm $form,
        AuthInterface $authService)
    {
        $this->router = $router;
        $this->template = $template;
        $this->form = $form;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $renderParams = [
            'form' => $this->form
        ];

        if ($request->getMethod() == 'POST') {
            //pega os dados da request
            $data = $request->getParsedBody();
            //seta os dados da request no form
            $this->form->setData($data);
            if ($this->form->isValid()) {
                $user = $this->form->getData();
                if ($this->authService->authenticate($user['email'], $user['password'])) {
                    $uri = $this->router->generateUri('customer.list');

                    return new RedirectResponse($uri);
                }
                $renderParams['message'] = "Login e/ou senha inválidos";
                $renderParams['messageType'] = 'error';
            }
        }
        return new HtmlResponse($this->template->render('app::login', $renderParams));
    }
}
