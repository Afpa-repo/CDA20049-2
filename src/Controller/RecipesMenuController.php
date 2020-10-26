<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipesMenuController extends AbstractController
{
    /**
     * @Route("/recipes/menu", name="recipes_menu")
     */
    public function index(): Response
    {
        $recipes=15;
        return $this->render('recipes_menu/index.html.twig', [
            'controller_name' => 'RecipesMenuController',
            'recipes' => $recipes
        ]);
    }
}
