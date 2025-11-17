<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProformaController extends AbstractController
{
    #[Route('/proforma', name: 'app_proforma')]
    public function index(): Response
    {
        return $this->render('proforma/index.html.twig', [
            'controller_name' => 'ProformaController',
        ]);
    }
}
