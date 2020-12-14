<?php
namespace App\Controller;

use App\Service\SpoonacularRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 * @method render(string $string, array $array)
 */
class RequestSpoonacularController  extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/RecipesSpoonacular/{category}_{number}", name="addRecipesSpoonacular", methods={"GET","POST"})
     */
    public function AddRecipesFromSpoonacular(SpoonacularRequest $spoonacularRequest,Request $request)
    {
        $category = $request->get('category');
        $number = intval($request->get('number'));
        $recipe = $spoonacularRequest->AddRecipesFromSpoonacular($number,$category);

        return new JsonResponse($recipe);
    }
}