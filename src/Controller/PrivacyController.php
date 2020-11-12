<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * @method render(string $string, array $array)
 */
class PrivacyController extends AbstractController {

    /**
     * @Route("/privacy", name="privacy_policy")
     */
    public function index() :Response
    {
        // Affichage de la page des conditions générales
        return $this->render('privacy/index.html.twig');
    }
}
?>