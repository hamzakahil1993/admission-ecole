<?php

namespace App\Controller;

use App\Entity\Assertion;
use App\Form\AssertionType;
use App\Repository\AssertionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/assertion')]
class AssertionController extends AbstractController
{
    #[Route('/', name: 'app_assertion_index', methods: ['GET'])]
    public function index(AssertionRepository $assertionRepository): Response
    {
        return $this->render('assertion/index.html.twig', [
            'assertions' => $assertionRepository->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_assertion_show', methods: ['GET'])]
    public function show(Assertion $assertion): Response
    {
        return $this->render('assertion/show.html.twig', [
            'assertion' => $assertion,
        ]);
    }
}
