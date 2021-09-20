<?php

namespace App\Controller;

use App\Mailer\Mailer;
use App\Entity\Contact;
use App\Form\Type\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private const EMAIL = "victor.besson@gmail.com";



    #[Route('/contact', name: 'contact')]
    public function index(Request $request, Mailer $mailer): Response
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);


        //Gestion du formulaire si il a été posté
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();
            $mailer->sendEmailToMe($contact);

            return $this->redirectToRoute('contact_submitted', [
                'name' => $contact->getNom() . ' ' . $contact->getPrenom()
            ]);
        }


        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView(),
        ]);
    }

    #[Route('/contact/{name}', name: 'contact_submitted')]
    public function contactSubmitted($name)
    {
        return $this->render('contact/contact_submitted.html.twig', [
            'name' => $name
        ]);
    }
}
