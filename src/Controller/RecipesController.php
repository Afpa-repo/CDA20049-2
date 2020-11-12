<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Entity\Category;
use App\Repository\UsersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\RecipesType;
use App\Repository\RecipeCategoryRepository;
use App\Repository\RecipesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function index(RecipesRepository $recipesRepository,RecipeCategoryRepository $recipeCategoryRepository,$currentPage = false): Response // $CurrentPage is optional
    {
        $categoriesList= $recipeCategoryRepository->findAll(); // Find all categories in DB
        $numberElements = 9; // Set the number of recipes per page
        $nbRecipes = $recipesRepository->countElement(); // Count recipes in DB
        $nbPage = intval(ceil(intval($nbRecipes[0][1])/$numberElements)); // Count necessary number of pages

        // Calculation of the proper offset to browse through recipes from database
        if($currentPage == 1 || !isset($currentPage) || !$currentPage){ //If CurrentPage is 1 or unset or false
            $offset = 0;
        } else{ // Else offset is set using the limit variable
            $offset = $currentPage-2 + $numberElements;
        }

        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipesRepository->findRecipesCustom($numberElements,$offset),
            'nbPage' => $nbPage,
            'currentPage' => $currentPage,
            'nbRecipes' =>$nbRecipes,
            'categories'=>$categoriesList,
        ]);
    }

    /**
     * @Route("/AJAXCategoryID", name="AJAX_Category_ID_Recipes", methods={"GET","POST"})
     */
    public function AJAXCategorySelected(RecipesRepository $recipesRepository,RecipeCategoryRepository $recipeCategoryRepository,Request $request) :Response
    {
        $categoriesList= $recipeCategoryRepository->findAll(); //Find all categories in DB
        $numberElements = 9; // Set the number of recipes per page
        $nbRecipes = $recipesRepository->countElement(); // Count recipes in DB
        $nbPage = ceil(intval($nbRecipes[0][1])/$numberElements); // Count necessary number of pages

        if($request->isXmlHttpRequest()) {
            $idCategory = $request->request->get('idCategory');

            if($idCategory != 0){ // If not 'All' category
                $nbRecipes = $recipesRepository->countElement($idCategory); // Count recipes in DB for this category
                $nbPage = ceil(intval($nbRecipes[0][1])/$numberElements); // Count necessary number of pages

            }

            return $this->render('recipes/indexAJAX.html.twig', [
                'recipes' => $recipesRepository->findRecipesCustom($numberElements,0,$idCategory),
                'nbPage' => $nbPage,
                'currentPage' => 1,
                'nbRecipes' =>$nbRecipes,
                'idCategory' => intval($idCategory),
                'categories'=>$categoriesList,
            ]);
        }

        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipesRepository->findLimit(9,0),
            'nbPage' => $nbPage,
            'currentPage' => 1,
            'nbRecipes' =>$nbRecipes,
            'categories'=>$categoriesList,
        ]);
    }

    /**
     * @Route("/AJAXListName", name="AJAX_liste_Recipes", methods={"GET","POST"})
     */
    public function AJAXListRecipes(RecipesRepository $recipesRepository,UsersRepository $usersRepository,Request $request): Response
    {
        if($request->isXmlHttpRequest()) {
            $recipesList = $recipesRepository->findAll();

            $data = [];

            foreach ($recipesList as $recipes){ // Get all recipes name in DB
                $recipesAuthorID=$recipes->getIdAuthor();
                $recipesAuthorName=$usersRepository->find($recipesAuthorID);

                array_push($data,array('name'=>$recipes->getName(),'author'=>$recipesAuthorName->getUsername()));
            }
            $response = new JsonResponse($data);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        return new Response('');
    }

    /**
     * @IsGranted("ROLE_USER")
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
            foreach ($recipe->getIngredients() as &$ingredient) {
                $entityManager->persist($ingredient);
            }
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
