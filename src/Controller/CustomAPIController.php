<?php
namespace App\Controller;

use App\Service\SpoonacularRequest;
use App\Service\VerifyUserRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 * @method render(string $string, array $array)
 */
class CustomAPIController  extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/RecipesSpoonacular/{category}_{number}", name="AddRecipesSpoonacular", methods={"GET","POST"})
     */
    public function AddRecipesFromSpoonacular(SpoonacularRequest $spoonacularRequest,Request $request): JsonResponse
    {
        $category = $request->get('category');
        $number = intval($request->get('number'));
        $recipe = $spoonacularRequest->AddRecipesFromSpoonacular($number,$category);

        return new JsonResponse($recipe);
    }

    /**
     * @Route("/CheckUserCredentials/{userLoginMail}_{userPlainPassword}", name="CheckUserCredentials", methods={"GET","POST"})
     */
    public function CheckUserCredentials(VerifyUserRequest $verifyUserRequest,Request $request): JsonResponse
    {
        $userLogin = $request->get('userLoginMail');
        $userPlainPassword = $request->get('userPlainPassword');

        return new JsonResponse( ["allowed" => $verifyUserRequest->CheckUserCredentials($userLogin,$userPlainPassword)]);
    }
}