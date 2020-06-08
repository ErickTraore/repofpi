<?php
// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from('traoreerickdaouda@gmail.com')
            ->to('fpilyon@hotmail.fr')
            ->subject('Template for Symfony Mailer!')
           
   // path of the Twig template to render
   ->htmlTemplate('emails/signup.html.twig')
    
   // pass variables (name => value) to the template
   ->context([
       'expiration_date' => new \DateTime('+7 days'),
       'username' => 'foo',
   ]);
        $mailer->send($email);
 //return $email;
        return new Response("phase une ok");
    }
}

