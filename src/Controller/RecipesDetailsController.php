<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipesDetailsController extends AbstractController
{
    /**
     * @Route("/recipes/details", name="recipes_details")
     */
    public function index(): Response
    {
        return $this->render('recipes_details/menu.html.twig', [
            'controller_name' => 'RecipesDetailsController',
        ]);
    }
}
