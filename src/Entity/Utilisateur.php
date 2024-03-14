<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
<<<<<<< HEAD


=======
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
<<<<<<< HEAD
        min:2,
        max:50,
        minMessage:'Le nom doit contenir au moins {{ limit }} caractères ',
        maxMessage:'Le nom ne doit pas dépasser {{ limit }} caractères'
=======
        min: 2,
        max: 50,
        minMessage: 'Votre nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre nom de doit pas contenir plus de {{ limit }} caractères',
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
<<<<<<< HEAD
        min:2,
        max:50,
        minMessage:'Le nom doit contenir au moins {{ limit }} caractères ',
        maxMessage:'Le nom ne doit pas dépasser {{ limit }} caractères'
=======
        min: 2,
        max: 50,
        minMessage: 'Votre prénom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre prénom de doit pas contenir plus de {{ limit }} caractères',
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Email(
<<<<<<< HEAD
        message: 'The email {{ value }} is not a valid email.',
=======
        message: 'Le mail suivant {{ value }} n\'est pas valide.',
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
    )]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
<<<<<<< HEAD

    #[Assert\Regex(
        pattern: "/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{12,}/",
        match: true,
        message: 'Password invalid',
=======
    #[Assert\Regex(
        pattern: "/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{12,}/",
        match: true,
        message: 'minimum 12 caractères, lettres minuscules, majuscules et nombres.',
>>>>>>> a38fd478b1a0f692ed4fc3191d16fc56cfd28684
    )]
    private ?string $password = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

}
