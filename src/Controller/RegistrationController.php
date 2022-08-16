<?php

namespace App\Controller;

use App\Entity\Tokens;
use App\Entity\Users;
use App\Form\EmailVerificationType;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticationAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(ManagerRegistry $doctrine, MailerInterface $mailer, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticationAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {

        $user = new Users();
        $token = new Tokens();
        $time = new \DateTime();
        $timeExpire = $time;
        $timeExpire->add(new \DateInterval('P2D'));
        $code = rand(100000, 999999);

//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        $check = $this->isGranted('IS_AUTHENTICATED_FULLY');
//        dd($check);

        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);
        $dataForm = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            if ($form->get('repeatPassword')->getData() == $form->get('plainPassword')->getData()) {

                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setPhoneNumber($dataForm->getphoneNumber());
                $user->setFirstName($dataForm->getfirstName());
                $user->setLastName($dataForm->getlastName());
                $user->setEmail($dataForm->getemail());
                $user->setDateCreate($time);
                $token->setCode($code);
                $token->setActiveAccount( 0);
                $token->setDataExpire($timeExpire);
                $user->setTokens($token);

                $entityManager->persist($user);
                $entityManager->flush();

                $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );

                $email = (new Email())
                    ->from('hello@example.com')
                    ->to($dataForm->getemail())
                    ->subject('Welcome to Hotel')
                    ->text("Witamy, miło, że do nas dołączyłeś/aś oto twój kod do potwierdzenia konta: $code");
                $mailer->send($email);

                return $this->redirectToRoute('app_token_verification');
            } else {
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                    'error' => 1,
                ]);
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
