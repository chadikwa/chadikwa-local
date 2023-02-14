<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subscription')]
class SubscriptionController extends AbstractController
{
    #[Route('/', name: 'app_subscription_index', methods: ['GET'])]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        return $this->render('subscription/list.html.twig');
    }

    #[Route('/new', name: 'app_subscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SubscriptionRepository $subscriptionRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            $subscription = new Subscription();
            $form = $this->createForm(SubscriptionType::class, $subscription);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $subscriptionRepository->save($subscription, true);

                return $this->redirectToRoute('app_subscription_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('subscription/new.html.twig', [
                'subscription' => $subscription,
                'form' => $form,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}', name: 'app_subscription_show', methods: ['GET'])]
    public function show(Subscription $subscription): Response
    {
        return $this->render('subscription/show.html.twig', [
            'subscription' => $subscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_subscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subscription $subscription, SubscriptionRepository $subscriptionRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            $form = $this->createForm(SubscriptionType::class, $subscription);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $subscriptionRepository->save($subscription, true);

                return $this->redirectToRoute('app_subscription_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('subscription/edit.html.twig', [
                'subscription' => $subscription,
                'form' => $form,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}', name: 'app_subscription_delete', methods: ['POST'])]
    public function delete(Request $request, Subscription $subscription, SubscriptionRepository $subscriptionRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            if ($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->request->get('_token'))) {
                $subscriptionRepository->remove($subscription, true);
            }

            return $this->redirectToRoute('app_subscription_index', [], Response::HTTP_SEE_OTHER);
        } else {
            throw $this->createNotFoundException();
        }
    }
}
