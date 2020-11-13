<?php

namespace App\Controller;

use app\Entity\Cart;
use App\Repository\IngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

      /*  if($session.isset($cart)){
            $cart = new Cart();
        }
        else{*/
            $cart = $session->get('cart');
//        }

        // Initialize empty array witch will get all data
        $cartWithData = [];

        // Initialize total equal to zero
        $total = 0;

        if(!empty($cart)){
            // Loop to get entity and its quantity for each element in cart
            foreach ($cart as $item){
                $id = $item['id']; //get id for the ingredient
                $ingredient = $ingredientsRepository->find($id); //get ingredient for specific id

                array_push($cartWithData,array('id'=>$id,'ingredient'=>$ingredient,'quantity'=>$item['quantity']));
            }

            // Loop to get price of each element in cart
            foreach ($cartWithData as $item) {
                $priceItem = $item['ingredient']->getPrice() * $item['quantity'];
                $total += $priceItem;
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' =>$total,
            $session->set('cart', $cartWithData),//creation donnee session pour validate
            $session->set('total', $total)
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
        $atrouver = false;//create variable bool

        if(!empty($cart)){//if cart is not empty boucle to research id to add quantity
            foreach ($cart as $index=>$element) {
                if($element['id']==$id) {//if element find add quantity as this element
                    $element['quantity']+=$quantity;
                    array_push($cart,array('id'=>$id,'ingredient'=>'','quantity'=>$element['quantity']));
                    unset($cart[$index]);//delete element cart
                    $atrouver = true;
                }
            }
        }
        // Add item to cart
        if(!$atrouver){//if atrouver = true push new id in cart
            array_push($cart,array('id'=>$id,'ingredient'=>'','quantity'=>$quantity));
        }

        // Set session variable cart
        $session->set('cart', $cart);

        return new Response();
    }

    /**
     * Remove item from cart
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


    /**
     * Remove all items from cart
     * @Route("/cart/remove", name="cart_remove_all")
     */
    public function removeall(SessionInterface $session) {
        $cart = $session->get('panier', []);
        $id = 1;
        $panier = 0;

        if(!empty($cart[$id])) {
            unset($panier[$id]);
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }


}
