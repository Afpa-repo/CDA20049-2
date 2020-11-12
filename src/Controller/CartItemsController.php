<?php

namespace App\Controller;

use App\Entity\CartItems;
use App\Form\CartItemsType;
use App\Repository\CartItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cartItems")
 */
class CartItemsController extends AbstractController
{
    /**
     * @Route("/", name="cart_items_index", methods={"GET"})
     */
    public function index(CartItemsRepository $cartItemsRepository): Response
    {
        return $this->render('cart_items/index.html.twig', [
            'cart_items' => $cartItemsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cart_items_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cartItem = new CartItems();
        $form = $this->createForm(CartItemsType::class, $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cartItem);
            $entityManager->flush();

            return $this->redirectToRoute('cart_items_index');
        }

        return $this->render('cart_items/new.html.twig', [
            'cart_item' => $cartItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_items_show", methods={"GET"})
     */
    public function show(CartItems $cartItem): Response
    {
        return $this->render('cart_items/show.html.twig', [
            'cart_item' => $cartItem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cart_items_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CartItems $cartItem): Response
    {
        $form = $this->createForm(CartItemsType::class, $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cart_items_index');
        }

        return $this->render('cart_items/edit.html.twig', [
            'cart_item' => $cartItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_items_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CartItems $cartItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cartItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cartItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_items_index');
    }
}
