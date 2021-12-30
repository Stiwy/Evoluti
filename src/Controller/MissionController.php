<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    #[Route('/missions', name: 'app_mission')]
    public function index(MissionRepository $missionRepository): Response
    {
        $header = 'mes missions';
        $missions = $missionRepository->findAll();

        return $this->render('pages/mission/index.html.twig', compact('missions', 'header'));
    }

    #[Route('/missions/nouveau', name: 'app_mission_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager, UserRepository $userRepository): Response
    {
        $customersOptions = array();
        $customers = $userRepository->findBy(['type' => 'customer']);
        foreach ($customers as $customer) {
            $customersOptions[$customer->getFirstname() . ' ' . $customer->getLastname() . ' | ' . $customer->getEmail()] = $customer;
        }

        $header = 'mes missions / Nouvelle mission';
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission, [
            'customers' => $customersOptions
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();
            $mission->setInsertDate(new \DateTime());

            $manager->persist($mission);
            $manager->flush();

            return $this->redirectToRoute('app_mission');
        }

        return $this->renderForm('pages/mission/form.html.twig', compact('form', 'header'));
    }
/*
    #[Route('/missions/{id}', name: 'app_mission_show', requirements: ["id"=>"\d+"], methods: ['GET'])]
    public function show(User $customer): Response
    {
        if ($customer->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $header = "mes missions / {$customer->getFirstname()} {$customer->getLastname()}";

        return $this->render('pages/customer/show.html.twig', compact('customer', 'header'));
    }

    #[Route('/missions/editer/{id}', name: 'app_mission_update', requirements: ["id"=>"\d+"], methods: ['GET', 'POST'])]
    public function update(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        if ($user->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $header = 'mes missions / Editer un client';
        $form = $this->createForm(CustomerType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setUpdatedDate(new \DateTime());

            $manager->flush();

            return $this->redirectToRoute('app_mission_show', ['id' => $user->getId()]);
        }

        return $this->renderForm('pages/customer/form.html.twig', compact('form', 'header'));
    }

    #[Route('/missions/supprimer/{id}', name: 'app_mission_delete', requirements: ["id"=>"\d+"], methods: ['GET'])]
    public function delete(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        if ($user->getType() !== "customer") {
            return throw $this->createNotFoundException('Le client demandé n\'existe pas');
        }

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('app_mission');
    }*/
}
