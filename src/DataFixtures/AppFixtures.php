<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use App\Entity\Article;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        //créer un tableau 
        $utilisateurs = [];
        for ($i=0; $i < 50; $i++) { 
            //création d'un objet utilisateur
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName());
            $utilisateur->setPrenom($faker->firstName('male'|'female'));
            $utilisateur->setEmail($faker->email());
            $utilisateur->setPassword($faker->md5());
            //mettre en cache l'objet
            $manager->persist($utilisateur);
            $utilisateurs[] = $utilisateur;
        }
        for ($i=0; $i < 200 ; $i++) { 
            $article = new Article();
            $article->setTitre($faker->word());
            $article->setContenu($faker->text(200));
            $article->setDateAjout(new \DateTimeImmutable($faker->date('Y-m-d')));
            $article->setUtilisateur($utilisateurs[$faker->numberBetween(0, 49)]);
            //mettre en cache l'objet 
            $manager->persist($article);
        }
        //ajouter en BDD
        $manager->flush();
    }
}
