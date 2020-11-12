<?php

namespace App\Controller;

use App\Form\ValidateCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ValidateCartController extends AbstractController
{
    /**
     * @Route("/validate/cart", name="validate_cart")
     */


        public function index(SessionInterface $session, Request $request): Response
        {
            // usually you'll want to make sure the user is authenticated first
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            // returns your User object, or null if the user is not authenticated
            // use inline documentation to tell your editor your exact User class
            /** @var \App\Entity\User $user */
            $user = $this->getUser();

            $cart = $session->get('cart');//retrieval of session data to display for validation
            $total = $session->get('total');

            $form = $this->createForm(ValidateCartType::class);
            $form->handleRequest($request);

            return $this->render('validate_cart/index.html.twig', [
                'items' => $cart,
                'total' => $total,
                'user' => $user,
                'validatecartForm' => $form->createView()
            ]);
        }

}
