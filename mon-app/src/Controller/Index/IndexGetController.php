<?php

namespace App\Controller\Index;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/',
    name: "app_index_get",//Nom de la route
)]
class IndexGetController extends AbstractController //Pour renvoyer des vues (à revoir)
{
    //Un controlleur symfony, récup un request et retourne une réponse (objet).
    public function __invoke(
        PostRepository $postRepository,
        #[MapQueryParameter]//Permet de dire que la variable correspond récupère la valeur en URL
        ?string $nom = null,
    ): Response
    {
        $allpost = $postRepository->getAllPublished();
        dump($allpost);

        dump($nom);
        //En url ?nom = djsn
        return $this->render(
            view: 'pages/index/index.html.twig',
            parameters: [
                'nom' => $nom,
                'published_posts' => $allpost,
            ]
        );
    }
}