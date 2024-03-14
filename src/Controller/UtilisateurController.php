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
use App\Repository\UtilisateurRepository;

class UtilisateurController extends AbstractController
{

<<<<<<< HEAD
    private EntityManagerInterface $em;
    private UtilisateurRepository $userRepo;

    public function __construct(EntityManagerInterface $em, UtilisateurRepository $userRepo)
=======
    public function __construct(private EntityManagerInterface $em, private UtilisateurRepository $userRepo) 
    {
    }

    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(Request $request): Response
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
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
<<<<<<< HEAD
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
=======
        if($form->isSubmitted() ) {
            //test si le formulaire est valide
            if($form->isValid()) {
                //test si le compte n'existe pas
                if(!$this->userRepo->findOneBy(["email" => $user->getEmail()])) {
                    //setter le password hash
                    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
                    //mettre en cache l'objet Utilisateur
                    $this->em->persist($user);
                    //enregistrer en BDD
                    $this->em->flush();
                    $type = "success";
                    $message = "le compte utilisateur : " . $user->getEmail() . " a éte ajouté en BDD";
                }
                //test si le compte existe
                else {
                    $type = "danger";
                    $message = "Le compte existe déja";
                }
            }
            //cas ou les entrées ne sont pas valides
            else {
             
                $type = "warning";
                $message = $form->getErrors(1)[0]->getMessage();
            }
            $this->addFlash($type, $message);
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
        }
        return $this->render('utilisateur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}