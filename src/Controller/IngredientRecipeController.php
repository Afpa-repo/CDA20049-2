<?php

namespace App\Controller;

use App\Entity\IngredientRecipe;
use App\Form\IngredientRecipeType;
use App\Repository\IngredientRecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredientrecipe")
 */
class IngredientRecipeController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_recipe_index", methods={"GET"})
     */
    public function index(IngredientRecipeRepository $ingredientRecipeRepository): Response
    {
        return $this->render('ingredient_recipe/index.html.twig', [
            'ingredient_recipes' => $ingredientRecipeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_recipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredientRecipe = new IngredientRecipe();
        $form = $this->createForm(IngredientRecipeType::class, $ingredientRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredientRecipe);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_recipe_index');
        }

        return $this->render('ingredient_recipe/new.html.twig', [
            'ingredient_recipe' => $ingredientRecipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_recipe_show", methods={"GET"})
     */
    public function show(IngredientRecipe $ingredientRecipe): Response
    {
        return $this->render('ingredient_recipe/show.html.twig', [
            'ingredient_recipe' => $ingredientRecipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_recipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IngredientRecipe $ingredientRecipe): Response
    {
        $form = $this->createForm(IngredientRecipeType::class, $ingredientRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_recipe_index');
        }

        return $this->render('ingredient_recipe/edit.html.twig', [
            'ingredient_recipe' => $ingredientRecipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_recipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IngredientRecipe $ingredientRecipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredientRecipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredientRecipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_recipe_index');
    }
}
