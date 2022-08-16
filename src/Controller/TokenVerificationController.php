<?php

namespace App\Controller;

use App\Entity\Tokens;
use App\Entity\Users;
use App\Form\EmailVerificationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TokenVerificationController extends AbstractController
{
    #[Route('/token/verification', name: 'app_token_verification')]
    public function index(Request $request, UserInterface $user, ManagerRegistry $doctrine, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $verificationForm = $this->createForm(EmailVerificationType::class);
        $verificationForm->handleRequest($request);
        $dataVerificationForm = $verificationForm->getData();
        $userRepo = $doctrine->getRepository(Users::class);
        $loogedInUser = $userRepo->findOneBy(['id' => $user->getId()]);
        $tokenFromDatabase = $loogedInUser->getTokens()->getCode();

        if (($verificationForm->isSubmitted() && $verificationForm->isValid()) && !is_null($dataVerificationForm))
        {
            $verificationCode = $verificationForm->get('code')->getData();

            if ($tokenFromDatabase == $verificationCode) {
                $tokenUpdate = $doctrine->getRepository(Tokens::class)->findOneBy([
                    'id' => $userRepo->findOneBy(['id' => $user->getId()])->getTokens()
                ])->setActiveAccount(true);
                $entityManager->persist($tokenUpdate);
                $entityManager->flush();

                return $this->render('index_user_page/index.html.twig', [
                ]);
            } else {
                $this->addFlash('danger','Niepoprawny kod !!!');
                return $this->render('token_verification/index.html.twig', [
                    'verificationForm' => $verificationForm->createView(),
                ]);
            }
        }
        $time = new \DateTime();

        if ((($request->query->get('sendTokenAgain') == true && $time > $loogedInUser->getTokens()->getNextEmailTime()) &&
            $loogedInUser->getTokens()->isActiveAccount() == 0) || $loogedInUser->getTokens()->getNextEmailTime() == null)
        {
            $nextEmailTime = $time->modify('+2 minutes');
            $code = rand(100000, 999999);
            $updateCode = $loogedInUser->getTokens()->setCode($code)->setNextEmailTime($nextEmailTime);
            $entityManager->persist($updateCode);
            $entityManager->flush();
            $newCode = $loogedInUser->getTokens()->getCode();

            $email = (new Email())
                ->from('hotel@hotelarownia.com')
                ->to($loogedInUser->getEmail())
                ->subject('Welcome to Hotel')
                ->text("Witamy, miło, że do nas dołączyłeś/aś oto twój kod do potwierdzenia konta: $newCode");
            $mailer->send($email);
            $this->addFlash('success','Email został wysłany');

            return $this->render('token_verification/index.html.twig', [
                'verificationForm' => $verificationForm->createView(),
            ]);
        } else if (new \DateTime() < $loogedInUser->getTokens()->getNextEmailTime()) {
            $this->addFlash('danger', 'Ponowny email z kodem można wysłać raz na dwie minuty');
        } else if ($loogedInUser->getTokens()->isActiveAccount() == true) {
            $this->addFlash('danger', 'Twoje konto jest już potwierdzone');
        }

        return $this->render('token_verification/index.html.twig', [
            'verificationForm' => $verificationForm->createView(),
        ]);
    }
}
