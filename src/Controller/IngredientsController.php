<?php

namespace App\Controller;

use App\Entity\Ingredients;
use App\Form\IngredientsType;
use App\Repository\IngredientCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\IngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                'user'=>$this->getUser(),
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
                'user'=>$this->getUser(),
            ]);
        }

        return $this->render('ingredients/index.html.twig', [
            'ingredients' => $ingredientsRepository->findIngredientsCustom(9,0),
            'nbPage' => $nbPage,
            'currentPage' => 1,
            'nbIngredients' =>$nbIngredients,
            'categories'=>$categoriesList,
            'user'=>$this->getUser(),
        ]);
    }

    /**
     * @Route("/AJAXListName", name="AJAX_liste_Ingredients", methods={"GET","POST"})
     */
    public function AJAXListRecipes(IngredientsRepository $ingredientsRepository,Request $request): Response
    {
        if($request->isXmlHttpRequest()) {
            $ingredientsList = $ingredientsRepository->findAll();

            $data = [];

            foreach ($ingredientsList as $ingredients){ // Get all recipes name in DB
                array_push($data,array('name'=>$ingredients->getName(),'id'=>$ingredients->getId()));
            }
            $response = new JsonResponse($data);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        return new Response('');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/LikeAJAX", name="AJAX_like_Ingredients", methods={"GET","POST"})
     */
    public function LikeAJAX(IngredientsRepository $ingredientsRepository,Request $request) : Response
    {
        if($request->isXmlHttpRequest()) {
            $id = $request->get('id');
            $operation = $request->get('operation');
            $ingredient = $ingredientsRepository->find($id); // Get recipe object for specific ID
            $entityManager= $this->getDoctrine()->getManager(); // Get recipe manager

            if ($operation === 'add'){
                $ingredient->addUsersFavorite($this->getUser());
                $entityManager->persist($ingredient);
                $entityManager->flush();

                return new Response('added');

            }else {
                $ingredient->removeUsersFavorite($this->getUser());
                $entityManager->persist($ingredient);
                $entityManager->flush();

                return new Response('removed');
            }

        }
        return new Response('');
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
            'user'=>$this->getUser(),
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
