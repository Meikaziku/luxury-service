<?php

namespace App\Controller;

use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route as AttributeRoute;

final class ContactController extends AbstractController
{
    #[AttributeRoute('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('ton_email@mailtrap.io') // remplace par ton adresse Mailtrap
                ->subject('Nouveau message depuis le formulaire de contact')
                ->html(
                    "<p><strong>Nom :</strong> {$data['first_name']} {$data['last_name']}</p>
                     <p><strong>Email :</strong> {$data['email']}</p>
                     <p><strong>Téléphone :</strong> {$data['phone']}</p>
                     <p><strong>Message :</strong><br>{$data['message']}</p>"
                );

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé !');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
