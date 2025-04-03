<?php

namespace App\Controller\Post\Show;

use App\Entity\Post;
use App\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/post/{id}/show',
    name: 'app_show_post_get',
)
    ]
class PostShowGetController extends AbstractController
{
    public function __invoke(Post $post): Response
    {
        $form = $this->CreateForm(
            type: PostType::class,
            data: $post,
            options: [
                'disabled'=> true,
            ]
        );
        return $this->render(
            view: 'pages/post/show/post-show.html.twig',
            parameters: [
                'page-title' => 'Détails article',
                'form' => $form->createView(),
            ]
        );
    }
}