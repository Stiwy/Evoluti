<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/clients', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('pages/customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }
}
