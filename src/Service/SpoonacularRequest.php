<?php
namespace App\Service;

use App\Entity\IngredientRecipe;
use App\Entity\Ingredients;
use App\Entity\Recipes;
use App\Repository\IngredientCategoryRepository;
use App\Repository\IngredientsRepository;
use App\Repository\OriginRepository;
use App\Repository\RecipeCategoryRepository;
use App\Repository\RecipesRepository;
use App\Repository\UnitsRepository;
use Doctrine\ORM\EntityManagerInterface;

class SpoonacularRequest
{
        protected $apiKey = '7dbf6a69290c4971a9ea8e019bfb3867';
        protected $recipeCategoryRepository;
        protected $recipesRepository;
        protected $ingredientsRepository;
        protected $ingredientCategoryRepository;
        protected $unitsRepository;
        protected $originRepository;
        protected $entityManager;

        public function __construct(RecipeCategoryRepository $recipeCategoryRepository,RecipesRepository $recipesRepository,IngredientsRepository $ingredientsRepository,IngredientCategoryRepository $ingredientCategoryRepository,UnitsRepository $unitsRepository,EntityManagerInterface $entityManager,OriginRepository $originRepository)
        {
            $this->recipeCategoryRepository = $recipeCategoryRepository;
            $this->recipesRepository = $recipesRepository;
            $this->ingredientsRepository = $ingredientsRepository;
            $this->ingredientCategoryRepository = $ingredientCategoryRepository;
            $this->unitsRepository = $unitsRepository;
            $this->originRepository = $originRepository;
            $this->entityManager = $entityManager;
        }

    /**
     * @param int $number - Number of recipes fetched from Spoonacular
     * @param string $category - Name of the category wanted
     * @return array of data which will be added to DB
     */
        function AddRecipesFromSpoonacular(int $number,string $category)
        {
            // Set parameters
            $parameters = [
                'apiKey' => $this->apiKey,  // Set the apiKey to be used for the request
                'number' => $number, // Number of recipes fetched
                'type' => $category, // Type of recipes fetched
                'addRecipeInformation' => 'true', // If set to true, you get more information about the recipes returned.
                'fillIngredients' => 'true', // Add information about the ingredients and whether they are used or missing in relation to the query.
                'instructionsRequired' => 'true', // Whether the recipes must have instructions.
            ];

            // Set URL with correct endpoint, see Spoonacular doc
            $url = 'https://api.spoonacular.com/recipes/complexSearch';

            // Get cURL resource
            $curl = curl_init();

            // Create query from parameters passed when calling the function
            $parameters_string = http_build_query($parameters);

            // Set curl options with specific URL and parameters
            $options = [
                CURLOPT_URL => $url.'?'.$parameters_string, // Set the request URL
                CURLOPT_RETURNTRANSFER => true, // Return data in case of curl request success
                CURLOPT_HTTPHEADER => array('Content-Type: application/json'), // Response header of Spoonacular are JSON
            ];

            // Add options and parameters to the curl session
            curl_setopt_array($curl, $options);

            // Execute the request & save data in $response
            if (!$response = curl_exec($curl)) {
                trigger_error(curl_error($curl));
            }
            // Close the request to clear up some resources
            curl_close($curl);

            // Decode JSON into associative array
            $response = json_decode($response, true);

            // Initialize array of results
            $data = [];

            // Search and arrange info from http response
            // Loop through all recipe
            foreach ($response['results'] as $index => $element) {

                $data[$index] = [
                    'name' => $element['title'],
                    'picture' => $element['image'],
                    'id' => $element['id'],
                    'category' => $category,
                    'instruction'=>[],
                    'persons'=>$element['servings'], //Get number of person for the recipe
                    'ingredient'=>[]
                ];

                // Loop through all instruction
                foreach ($element['analyzedInstructions'][0]['steps'] as $number => $instruction) {
                    array_push($data[$index]['instruction'],$instruction['step']);
                }

                // Loop through all ingredient
                foreach ($element['extendedIngredients'] as $number => $ingredient) {
                    array_push($data[$index]['ingredient'],[
                        'id'=>$ingredient['id'],
                        'name'=>$ingredient['name'],
                        'picture'=>$ingredient['image'],
                        'measures'=>$ingredient['measures']['metric']['unitLong'],
                        'amount'=>$ingredient['measures']['metric']['amount']/$data[$index]['persons']]); //Divide quantity by number of person
                }
            }

            // Add elements to DB
            $recipe = []; // Initialize array of recipes

            $category = $this->recipeCategoryRepository->findOneBy(array('name'=>$category)); //Get the category from DB

            foreach ($data as $indexRecipe => $recipe) { // Loop through all recipe from request

                $recipe[$indexRecipe] = $this->recipesRepository->findOneBy(array('name'=>$recipe['name'])); // Search for the recipe in DB

                if(!$recipe[$indexRecipe]){ // If the recipe doesn't already exist in DB, add it

                    $recipe[$indexRecipe] = new Recipes(); //Create a new recipe
                    $this->entityManager->persist($recipe[$indexRecipe]); // Follow change on recipe to the DB

                    //Set information for the recipe
                    $recipe[$indexRecipe]->setName($recipe['name']);
                    $recipe[$indexRecipe]->setPicture($recipe['picture']);
                    $recipe[$indexRecipe]->setIdAuthor(3);
                    $recipe[$indexRecipe]->setCategory($category);
                    $recipe[$indexRecipe]->setInstructions($recipe['instruction']);

                    foreach($data[$indexRecipe]['ingredient'] as $indexIngredient=>$ingredient){ // Loop through all ingredient for each recipe

                        $ingredient[$indexIngredient] = $this->ingredientsRepository->findOneBy(array('name'=>$ingredient['name'])); // Search for the ingredient in DB

                        if(!$ingredient[$indexIngredient]) { // If the ingredient doesn't already exist in DB, add it

                            $ingredient[$indexIngredient] = new Ingredients(); //Create a new ingredient
                            $this->entityManager->persist($ingredient[$indexIngredient]); // Follow change on ingredient to the DB

                            //Set information for the ingredient
                            $ingredient[$indexIngredient]->setName($ingredient['name']);
                            $ingredient[$indexIngredient]->setPicture('https://spoonacular.com/cdn/ingredients_500x500/'.$ingredient['picture']);
                            $ingredient[$indexIngredient]->setPrice((rand(1, 3))); //Random price for each unit, range from 1 to 3
                            $ingredient[$indexIngredient]->setShelfLife(ceil(rand(0, 20))); //Random shelf life,rounded, range from 0 to 20
                            $ingredient[$indexIngredient]->setCategory($this->ingredientCategoryRepository->find(ceil(rand(1,4))));  //Random ingredient category
                            $ingredient[$indexIngredient]->setUnit($this->unitsRepository->find(ceil(rand(1,2)))); //Random unit
                            $ingredient[$indexIngredient]->setTempMax((rand(20, 30))); //Random max temperature,rounded, range from 20 to 30
                            $ingredient[$indexIngredient]->setTempMin((rand(5, 19))); //Random min temperature,rounded, range from 5 to 19
                            $ingredient[$indexIngredient]->setOrigin($this->originRepository->find(ceil(rand(1, 250)))); //Random origin
                        }

                        $ingredientRecipe[$indexIngredient] = new IngredientRecipe(); //Create a new ingredient recipe relation
                        $this->entityManager->persist($ingredientRecipe[$indexIngredient]); // Follow change on ingredient recipe relation to the DB

                        //Set information for the ingredient/recipe relation
                        $ingredientRecipe[$indexIngredient]->setIngredient($ingredient[$indexIngredient]);
                        $ingredientRecipe[$indexIngredient]->setRecipe($recipe[$indexRecipe]);
                        $ingredientRecipe[$indexIngredient]->setQuantity($ingredient['amount']);

                        $recipe[$indexRecipe]->addIngredient($ingredientRecipe[$indexIngredient]); // Add ingredient to the recipe
                    }

                    $this->entityManager->flush();
                }

            }
            return $recipe;
        }
}