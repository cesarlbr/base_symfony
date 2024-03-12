<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    public function __construct(private ArticleRepository $articleRepository) {      
    }

    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        //récupération de la liste des articles
        $articles = $this->articleRepository->findAll();
        //retourner la vue
        return $this->render('article/index.html.twig', [
            'liste' => $articles,
        ]);
    }

    #[Route('/article/{id}', name:'app_article_id')]
    public function articleById($id) : Response 
    {
        //récupération de l'article
        $article = $this->articleRepository->find($id);
        //test si l'article n'existe pas
        if(!$article) {
            //redirection vers la liste des articles
            return $this->redirectToRoute('app_article');
        }
        //retourner la vue 
        return $this->render('article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
