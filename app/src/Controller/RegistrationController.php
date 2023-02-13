<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app');
        }
        else {
            $user = new User();
            $form = $this->createForm(RegistrationFormType::class, $user);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setRoles($user->getRoles());
    
                // $client = HttpClient::create();
    
                // try {
                //     $response = $client->request('POST', 'http://127.0.0.1:8000/authentication_token', [
                //         'json' => [
                //             'email' => $form->get('email')->getData(),
                //             'password' => $form->get('plainPassword')->getData()
                //         ]
                //     ]);
                //     $content = $response->getContent();
                //     if (!empty($content)) {
                //         $object = json_decode($content);
    
                //         echo $object;
    
                //         $user->setToken($object->{'token'});
                //     }
                // } catch (\Exception $error) {
                //     echo $error->getMessage();
                // }
    
                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email
    
                return $this->redirectToRoute('app');
        }
        
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
