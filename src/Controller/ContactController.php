<?php

namespace App\Controller;

use App\Form\ContactType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            //ici on envoie le mail
            $message = (new Swift_Message('Comment'))
                //attribue l'expediteur
                ->setFrom($contact['email'])

                //attribue destinataire
                ->setTo('reptail80hotmail@gmail.com')

                //on cree le message
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                );
            //on envoie le message
            $mailer->send($message);
            return $this->redirectToRoute('home');
        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}