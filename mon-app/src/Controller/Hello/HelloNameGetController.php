<?php

namespace App\Controller\Hello;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route(
    path: '/hello/{name}',
    name: 'app_hello_name_get',
    methods: [Request::METHOD_GET],
)]
class HelloNameGetController extends AbstractController
{

    public function __invoke(string $name): Response
    {
        return $this->render('pages/hello/hello.html.twig');
    }
}