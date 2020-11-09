<?php

namespace App\Controller;

use App\Repository\IngredientsRepository;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\LazyProxy\Instantiator\RealServiceInstantiator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session, IngredientsRepository $ingredientsRepository)
    {
        $cart = $session->get('cart');

        // Initialize empty array witch will get all data
        $cartWithData = [];

        // Loop to get entity and its quantity for each element in cart
        foreach ($cart as $item){
            $id = $item['id']; //get id for the ingredient
            $ingredient = $ingredientsRepository->find($id); //get ingredient for specific id

            array_push($cartWithData,array('ingredient'=>$ingredient,'quantity'=>$item['quantity']));
        }

        // Initialize total equal to zero
        $total = 0;

        // Loop to get price of each element in cart
        foreach ($cartWithData as $item) {
            $ingredient = $cartWithData[0]['ingredient'];
            $priceItem = $ingredient->getPrice() * $item['quantity'];
            $total += $priceItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' =>$total
        ]);
    }

    /**
     * @Route ("/cart/add", name="cart_add", methods={"GET","POST"})
     */
    public function add(Request $request, SessionInterface $session) {

        // Create cart array
        $cart = $session->get('cart', []);

        // Get data from AJAX request
        $id = $request->request->get('id');
        $quantity = $request->request->get('quantity');

        // Add item to cart
        array_push($cart,array('id'=>$id,'quantity'=>$quantity));

        // Set session variable cart
        $session->set('cart', $cart);

        return new Response();
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session) {
        // Get cart infos
        $cart = $session->get('cart');

        // Find and delete the item
        foreach ($cart as $index=>$item) {
            if ($item['id'] == $id){
                unset($cart[$index]);
            }
        }

        // Save deletion of the item
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }
}
