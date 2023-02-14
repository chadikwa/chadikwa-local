<?php

namespace App\Controller;

use App\Entity\Contribute;
use App\Form\ContributeType;
use App\Repository\ContributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contribute')]
class ContributeController extends AbstractController
{
    #[Route('/', name: 'app_contribute_index', methods: ['GET'])]
    public function index(ContributeRepository $contributeRepository): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('app_contribute_new', [], Response::HTTP_SEE_OTHER);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/new', name: 'app_contribute_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContributeRepository $contributeRepository): Response
    {
        $contribute = new Contribute();
        $form = $this->createForm(ContributeType::class, $contribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contributeRepository->save($contribute, true);

            return $this->redirectToRoute('app_contribute_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contribute/new.html.twig', [
            'contribute' => $contribute,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contribute_show', methods: ['GET'])]
    public function show(Contribute $contribute): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            return $this->render('contribute/show.html.twig', [
                'contribute' => $contribute,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}/edit', name: 'app_contribute_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contribute $contribute, ContributeRepository $contributeRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            $form = $this->createForm(ContributeType::class, $contribute);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $contributeRepository->save($contribute, true);

                return $this->redirectToRoute('app_contribute_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('contribute/edit.html.twig', [
                'contribute' => $contribute,
                'form' => $form,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}', name: 'app_contribute_delete', methods: ['POST'])]
    public function delete(Request $request, Contribute $contribute, ContributeRepository $contributeRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            if ($this->isCsrfTokenValid('delete'.$contribute->getId(), $request->request->get('_token'))) {
                $contributeRepository->remove($contribute, true);
            }

            return $this->redirectToRoute('app_contribute_index', [], Response::HTTP_SEE_OTHER);
        } else {
            throw $this->createNotFoundException();
        }
    }
}
