<?php

namespace App\Controller;

use App\Entity\Assertion;
use App\Entity\AssertionDocument;
use App\Form\AssertionType;
use App\Form\MultipleFileUploadType;
use App\Repository\AssertionRepository;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MailerInterface $mailer): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/new-assertion', name: 'app_assertion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EmailService $emailService, AssertionRepository $assertionRepository): Response
    {
        $assertion = new Assertion();
        $form = $this->createForm(AssertionType::class, $assertion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $assertionOld = $assertionRepository->findOneBy(['email' => $email]);
            if ($assertionOld instanceof Assertion) {
                return $this->redirectToRoute('app_assertion_success', ['isSuccess' => false], Response::HTTP_SEE_OTHER);
            }
            $countryCode = $form->get('countryPhoneCode')->getData();
            $phoneNumber = $assertion->getPhoneNumber();
            if (substr($phoneNumber, 0, 1) === '+') {
                $fullPhoneNumber = $phoneNumber;
            } else {
                if (substr($phoneNumber, 0, 1) === '0') {
                    $phoneNumber = substr($phoneNumber, 1);
                }
                $fullPhoneNumber = $countryCode . $phoneNumber;
            }
            $assertion->setPhoneNumber($fullPhoneNumber);
            $entityManager->persist($assertion);
            $entityManager->flush();
            $emailService->sendEmailNewAssertion($assertion);
            return $this->redirectToRoute('app_assertion_documents', ['id' => $assertion->getId()], Response::HTTP_SEE_OTHER);  
        }

        return $this->render('home/new.html.twig', [
            'assertion' => $assertion,
            'form' => $form,
        ]);
    }

    #[Route('/new-assertion/{id}/documents', name: 'app_assertion_documents', methods: ['GET', 'POST'])]
    public function documents(
        Assertion $assertion, 
        Request $request, 
        EntityManagerInterface $entityManager, 
        EmailService $emailService,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(MultipleFileUploadType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFiles = $form->get('documents')->getData();
            foreach ($uploadedFiles as $file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
                $document = (new AssertionDocument())
                    ->setAssertion($assertion)
                    ->setName($fileName);
                $entityManager->persist($document);
                $entityManager->flush();
                $file->move($this->getParameter('uploads_directory'), $fileName);
            }
            $emailService->sendEmailNewAssertionDocuements($assertion);

            return $this->redirectToRoute('app_assertion_success', ['isSuccess' => true], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/documents.html.twig', [
            'form' => $form,
            'assertion' => $assertion,
        ]);
    }

    #[Route('/success-assertion', name: 'app_assertion_success')]
    public function success(Request $request): Response
    {
        $isSuccess = $request->query->get('isSuccess');

        return $this->render('home/success_assertion.html.twig', [
            'is_success' => $isSuccess
        ]);
    }
}
