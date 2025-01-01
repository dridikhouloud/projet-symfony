<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Userr;
use App\Form\RegistrationFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;

class UserrController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(Request $request, Security $security): Response
    {
        // Si l'utilisateur est déjà connecté, redirigez-le
        if ($security->getUser()) {
            return $this->redirectToRoute('home');
        }

        // Si une erreur existe (comme une erreur de login), elle est transmise à Twig
        $error = $request->attributes->get('error');

        return $this->render('security/login.html.twig', [
            'error' => $error,  // Passe l'erreur à Twig
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode est vide, elle sera interceptée par Symfony
        throw new \LogicException('This method will never be called.');
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $user = new Userr();

        // Créez le formulaire d'inscription
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $password = $form->get('password')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            // Vérifier que les mots de passe correspondent
            if ($password !== $confirmPassword) {
                $form->get('confirmPassword')->addError(new FormError('Les mots de passe doivent correspondre.'));
                return $this->render('security/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            // Encoder le mot de passe avant de l'enregistrer
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            // Attribuer le rôle par défaut (ROLE_USER)
            $user->setRoles(['ROLE_USER']);  // Par défaut, un utilisateur aura le rôle ROLE_USER

            // Sauvegarder l'utilisateur dans la base de données
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Rediriger vers la page de connexion après l'inscription
            return $this->redirectToRoute('app_login');
        }

        // Afficher le formulaire d'inscription
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
