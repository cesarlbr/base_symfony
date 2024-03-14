<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\UtilisateurType;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;


class UtilisateurController extends AbstractController
{

    private EntityManagerInterface $em;
    private UtilisateurRepository $userRepo;

    public function __construct(EntityManagerInterface $em, UtilisateurRepository $userRepo)
    {
        $this->em = $em;
        $this->userRepo = $userRepo;
    }

    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function addUser(Request $request, EntityManagerInterface $em): Response
    {

        //créer un objet utilisateur
        $user = new Utilisateur();
        //créer un objet UtilisateurType (formulaire)
        $form = $this->createForm(UtilisateurType::class, $user);
        //récupérer les données du fomulaire
        $form->handleRequest($request);
        //tester si le formulaire est submit
        if ($form->isSubmitted()) {
            //mettre en cache l'objet Utilisateur
            if ($form->isValid()) {
                if (!$this->userRepo->findOneByEmail($user->getEmail())) {
                    $user->setPassword(md5($user->getPassword()));
                    $em->persist($user);
                    //enregistrer en BDD
                    $em->flush();
                    $type = "success";
                    $message = "Utilisateur ok";
                } else {
                    // dd($form->getErrors(true));
                    $type = "warning";
                    $message = "Utilisateur existant";
                }
                $this->addFlash($type, $message);
            }else{
                $type = "warning";
                $message = $form->getErrors(1)[0]->getMessage();
            } 
        }
        return $this->render('utilisateur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}