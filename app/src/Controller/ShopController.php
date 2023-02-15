<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shop')]
class ShopController extends AbstractController
{
    #[Route('/', name: 'app_shop_index', methods: ['GET'])]
    public function index(ShopRepository $shopRepository): Response
    {
        if($this->getUser()) {
            return $this->render('shop/index.html.twig', [
                'shops' => $shopRepository->findAll(),
            ]);
        } else {
            throw $this->createNotFoundException();
        }
        
    }

    #[Route('/new', name: 'app_shop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ShopRepository $shopRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            $shop = new Shop();
            $form = $this->createForm(ShopType::class, $shop);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $shopRepository->save($shop, true);

                return $this->redirectToRoute('app_shop_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('shop/new.html.twig', [
                'shop' => $shop,
                'form' => $form,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}', name: 'app_shop_show', methods: ['GET'])]
    public function show(Shop $shop): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            return $this->render('shop/show.html.twig', [
                'shop' => $shop,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}/edit', name: 'app_shop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Shop $shop, ShopRepository $shopRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            $form = $this->createForm(ShopType::class, $shop);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $shopRepository->save($shop, true);

                return $this->redirectToRoute('app_shop_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('shop/edit.html.twig', [
                'shop' => $shop,
                'form' => $form,
            ]);
        } else {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/{id}', name: 'app_shop_delete', methods: ['POST'])]
    public function delete(Request $request, Shop $shop, ShopRepository $shopRepository): Response
    {
        if($this->getUser()->getRoles() === "ROLE_ADMIN") {
            if ($this->isCsrfTokenValid('delete'.$shop->getId(), $request->request->get('_token'))) {
                $shopRepository->remove($shop, true);
            }

            return $this->redirectToRoute('app_shop_index', [], Response::HTTP_SEE_OTHER);
        } else {
            throw $this->createNotFoundException();
        }
    }
}
