<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;

class CategorieController extends AbstractController
{
    #[Route('/categorie/add', name : 'app_categorie_add')]
    public function addCategorie(Request $request, EntityManagerInterface $em, CategorieRepository $catRepo) : Response 
    {
        //créer un objet categorie
        $cat = new Categorie();
        //créer un objet CategorieType (formulaire)
        $form = $this->createForm(CategorieType::class, $cat);
        //récupére le contenu de la requête
        $form->handleRequest($request);
        //vérifier quand le formulaire est submit
        if($form->isSubmitted()  ) {
            /* dd($form->getErrors()); */
            //test si le catégorie n'existe pas
            if(!$catRepo->findOneBy(["nom" => $cat->getNom()])) {
                //mettre en cache
                $em->persist($cat);
                //enregistrer en BDD
                $em->flush();
                //message de confirmation
                $type = "success";
                $message = "La catégorie a été ajouté";
            }
            //test si la catégorie existe
            else{
                $type = "danger";
                $message = "La catégorie existe déja";
            }
            $this->addFlash($type, $message);
        }
        return $this->render('categorie/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
