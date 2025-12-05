<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }
    #[Route('/politique/confidentialite', name: 'app_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('home/politique-confidentialite.html.twig', []);
    }
    #[Route('/conditions/utilisation', name: 'app_condition_utilisation')]
    public function politiqueUtilisation(): Response
    {
        return $this->render('home/conditions-utilisation.html.twig', []);
    }
    #[Route('/politique/utilisation/cookies', name: 'app_utilisation_cookies')]
    public function politiqueCookie(): Response
    {
        return $this->render('home/politique-utilisation-cookie.html.twig', []);
    }
}
