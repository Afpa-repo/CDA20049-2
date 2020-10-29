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
     * @Route("/", name="recipes_index", methods={"GET"})
     */
    public function index(RecipesRepository $recipesRepository): Response
    {
        static $limit = 9;
        static $offset = 0;
        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipesRepository->findLimit($limit,$offset),
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
