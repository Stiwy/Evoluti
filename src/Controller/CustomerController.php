<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CustomerType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/clients', name: 'app_customer')]
    public function index(UserRepository $userRepository): Response
    {
        $header = 'mes clients';
        $customers = $userRepository->findBy(['type' => 'customer']);

        return $this->render('pages/customer/index.html.twig', compact('customers', 'header'));
    }

    #[Route('/clients/nouveau', name: 'app_customer_create', methods: ['GET', 'POST'])]
    public function create(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager): Response
    {
        $header = 'mes clients / nouveau client';
        $user = new User();
        $form = $this->createForm(CustomerType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $hasher->hashPassword($user, $user->getEmail() . $user->getZipCode());
            $user->setPassword($password);
            $user->setInsertDate(new \DateTime());
            $user->setType('customer');

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_customer');
        }

        return $this->renderForm('pages/customer/form.html.twig', compact('form', 'header'));
    }

    #[Route('/clients/{id}', name: 'app_customer_show', requirements: ["id"=>"\d+"], methods: ['GET'])]
    public function show(User $customer): Response
    {
        if ($customer->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $header = "mes clients / {$customer->getFirstname()} {$customer->getLastname()}";

        return $this->render('pages/customer/show.html.twig', compact('customer', 'header'));
    }

    #[Route('/clients/editer/{id}', name: 'app_customer_update', requirements: ["id"=>"\d+"], methods: ['GET', 'POST'])]
    public function update(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        if ($user->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $header = 'mes clients / Editer un client';
        $form = $this->createForm(CustomerType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setUpdatedDate(new \DateTime());

            $manager->flush();

            return $this->redirectToRoute('app_customer_show', ['id' => $user->getId()]);
        }

        return $this->renderForm('pages/customer/form.html.twig', compact('form', 'header'));
    }

    #[Route('/clients/supprimer/{id}', name: 'app_customer_delete', requirements: ["id"=>"\d+"], methods: ['GET'])]
    public function delete(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        if ($user->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('app_customer');
    }
}
