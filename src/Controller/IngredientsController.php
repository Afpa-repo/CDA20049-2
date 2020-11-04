<?php

namespace App\Controller;

use App\Entity\Ingredients;
use App\Form\IngredientsType;
use App\Repository\IngredientCategoryRepository;
use App\Repository\IngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredients")
 */
class IngredientsController extends AbstractController
{
    /**
     * @Route("/page_{currentPage}", name="ingredients_index", methods={"GET"})
     */
    public function index(IngredientsRepository $ingredientsRepository,IngredientCategoryRepository $ingredientCategoryRepository,$currentPage = false): Response // $CurrentPage is optional
    {
        {
            $categoriesList= $ingredientCategoryRepository->findAll(); // Find all categories in DB
            $numberElements = 9; // Set the number of ingredients per page
            $nbIngredients = $ingredientsRepository->countElement(); // Count ingredients in DB
            $nbPage = intval(ceil(intval($nbIngredients[0][1])/$numberElements)); // Count necessary number of pages

            // Calculation of the proper offset to browse through ingredients from database
            if($currentPage == 1 || !isset($currentPage) || !$currentPage){ //If CurrentPage is 1 or unset or false
                $offset = 0;
            } else{ // Else offset is set using the limit variable
                $offset = $currentPage-2 + $numberElements;
            }

            return $this->render('ingredients/index.html.twig', [
                'ingredients' => $ingredientsRepository->findIngredientsCustom($numberElements,$offset),
                'nbPage' => $nbPage,
                'currentPage' => $currentPage,
                'nbIngredients' =>$nbIngredients,
                'categories'=>$categoriesList,
            ]);
        }
    }

    /**
     * @Route("/AJAXCategoryID", name="AJAX_Category_ID_Ingredients", methods={"GET","POST"})
     */
    public function AJAXCategorySelected(IngredientsRepository $ingredientsRepository,IngredientCategoryRepository $ingredientCategoryRepository,Request $request) :Response
    {
        $categoriesList= $ingredientCategoryRepository->findAll(); //Find all categories in DB
        $numberElements = 9; // Set the number of ingredients per page
        $nbIngredients = $ingredientsRepository->countElement(); // Count ingredients in DB
        $nbPage = ceil(intval($nbIngredients[0][1])/$numberElements); // Count necessary number of pages

        if($request->isXmlHttpRequest()) {
            $idCategory = $request->request->get('idCategory');

            if($idCategory != 0){ // If not 'All' category
                $nbIngredients = $ingredientsRepository->countElement($idCategory); // Count ingredients in DB for this category

            }

            return $this->render('ingredients/indexAJAX.html.twig', [
                'ingredients' => $ingredientsRepository->findIngredientsCustom($numberElements,0,$idCategory),
                'nbPage' => $nbPage,
                'currentPage' => 1,
                'nbIngredients' =>$nbIngredients,
                'idCategory' => intval($idCategory),
                'categories'=>$categoriesList,
            ]);
        }

        return $this->render('ingredients/index.html.twig', [
            'ingredients' => $ingredientsRepository->findIngredientsCustom(9,0),
            'nbPage' => $nbPage,
            'currentPage' => 1,
            'nbIngredients' =>$nbIngredients,
            'categories'=>$categoriesList,
        ]);
    }

    /**
     * @Route("/new", name="ingredients_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredient = new Ingredients();
        $form = $this->createForm(IngredientsType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('ingredients_index');
        }

        return $this->render('ingredients/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredients_show", methods={"GET"})
     */
    public function show(Ingredients $ingredient): Response
    {

        return $this->render('ingredients/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredients_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ingredients $ingredient): Response
    {
        $form = $this->createForm(IngredientsType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredients_index');
        }

        return $this->render('ingredients/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredients_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ingredients $ingredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredients_index');
    }
}
