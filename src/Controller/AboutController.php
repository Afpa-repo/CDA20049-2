<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * @method render(string $string, array $array)
 */
class AboutController extends AbstractController {

    /**
     * @Route("/about", name="about")
     */
    public function index() :Response
    {
        // Affichage de la page about
        return $this->render('about/index.html.twig');
    }
}
?>