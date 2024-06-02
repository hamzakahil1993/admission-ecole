<?php

namespace App\Controller;

use App\Entity\Assertion;
use App\Form\AssertionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/new-assertion', name: 'app_assertion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assertion = new Assertion();
        $form = $this->createForm(AssertionType::class, $assertion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assertion);
            $entityManager->flush();

            return $this->redirectToRoute('app_assertion_success', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/new.html.twig', [
            'assertion' => $assertion,
            'form' => $form,
        ]);
    }

    #[Route('/success-assertion', name: 'app_assertion_success')]
    public function success(): Response
    {
        return $this->render('home/success_assertion.html.twig', []);
    }


}