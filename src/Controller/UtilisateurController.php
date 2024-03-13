<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\UtilisateurType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;


class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        
        //créer un objet utilisateur
        $user = new Utilisateur();
        //créer un objet UtilisateurType (formulaire)
        $form = $this->createForm(UtilisateurType::class, $user);
        //récupérer les données du fomulaire
        $form->handleRequest($request);
        //tester si le formulaire est submit
        if($form->isSubmitted() ) {
            //mettre en cache l'objet Utilisateur
            $em->persist($user);
            //enregistrer en BDD
            $em->flush();
            $this->addFlash('warning', "Le compte à bien été ajouté en BDD");
        }
        return $this->render('utilisateur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
