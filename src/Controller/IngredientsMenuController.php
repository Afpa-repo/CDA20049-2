<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsMenuController extends AbstractController
{
    /**
     * @Route("/ingredients/menu", name="ingredients_menu")
     */
    public function index(): Response
    {
        $ingredients=9;
        return $this->render('ingredients_menu/index.html.twig', [
            'controller_name' => 'IngredientsMenuController',
            'ingredients' => $ingredients
        ]);
    }
}
