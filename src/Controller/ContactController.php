<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Type\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);



        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView(),
        ]);
    }
}
