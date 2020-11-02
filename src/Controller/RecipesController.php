<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Form\RecipesType;
use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipes")
 */
class RecipesController extends AbstractController
{
    /**
     * @Route("/page_{currentPage}", name="recipes_index", methods={"GET"})
     */
    public function index(RecipesRepository $recipesRepository, $currentPage = false): Response // $CurrentPage is optional
    {
        $numberElements = 9; // Set the number of recipes per page

        // Calculation of the proper offset to browse through recipes from database
        if($currentPage == 1 || !isset($currentPage) || !$currentPage){ //If CurrentPage is 1 or unset or false
            $offset = 0;
        } else{ // Else offset is set using the limit variable
            $offset = $currentPage-2 + $numberElements;
        }

        $nbRecipes = $recipesRepository->countElement(); // Count recipes in DB
        $nbPage = intval(ceil(intval($nbRecipes[0][1])/$numberElements)); // Count necessary number of pages

        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipesRepository->findLimit($numberElements,$offset,1),
            'nbPage' => $nbPage,
            'currentPage' => $currentPage
        ]);
    }

    /**
     * @Route("/new", name="recipes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipes();
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipes_index');
        }

        return $this->render('recipes/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipes_show", methods={"GET"})
     */
    public function show(Recipes $recipe): Response
    {
        return $this->render('recipes/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recipes $recipe): Response
    {
        $form = $this->createForm(RecipesType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipes_index');
        }

        return $this->render('recipes/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recipes $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipes_index');
    }
}
