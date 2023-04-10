<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RegisterUserForm;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserController extends AbstractController
{
    #[Route('/admin/user-registration', name: 'app_admin_user_registration')]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {

        $user = new User();

        /**
         * Save the form into a variable and validate it
         */
        $formRegisterUser = $this->createForm(RegisterUserForm::class, $user);
        $formRegisterUser->handleRequest($request);

        if ($formRegisterUser->isSubmitted() && $formRegisterUser->isValid()) {
            $formInputs = $formRegisterUser->getData();

            $user->setEmail($formInputs['email']);
            $user->setRoles([$formInputs['roles']]);
            $user->setPassword($passwordHasher->hashPassword($user, $formInputs['password']));

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            // Redirect to somewhere after the registration
        }

        return $this->render('admin/register-user.html.twig', [
            'formRegisterUser' => $formRegisterUser->createView()
        ]);
    }
}