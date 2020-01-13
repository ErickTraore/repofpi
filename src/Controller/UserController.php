<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\AdhesionRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/makeCarte", name="user_makeCarte")
     */
    public function makeCarte():Response
    {
        $user = $this->getUser();
        $adhesion = $user->getAdhesion();
        $adhesionId = $adhesion->getId();
        $adhesionfirstname = $adhesion->getFirstName();
        $adhesionlastname = $adhesion->getLastname();
        $adhesionbirthday = $adhesion->getBirthday();
        $adhesionlieunaiss = $adhesion->getlieunaissance();
        $adhesiongender = $adhesion->getGender();
        $adhesionprofession = $adhesion->getProfession();
        // $adhesion = $adhesion->get();
        // $adhesion = $adhesion->get();
        // $adhesion = $adhesion->get();
        // $adhesion = $adhesion->get();
       
        // $counts = $countRepository->findBy(
       //     array('adhesion' => $adhesionId) // Critere 
       // );
       
        //return new Response('et alors');
        return $this->render('user/makeCarte.html.twig'
        ,[
            // 'counts' => $counts,
            'adhesiongender'=> $adhesiongender,
            'adhesionId' => $adhesionId,
            'adhesionfirstname' => $adhesionfirstname,
            'adhesionlastname' => $adhesionlastname,
            'adhesionbirthday' => $adhesionbirthday,
            'adhesionlieunaiss' => $adhesionlieunaiss,
            'adhesionprofession'=> $adhesionprofession 
        ]);
    }

    /**
     * @Route("/{id}/show", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

     /**
     * @Route("/index", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, AdhesionRepository $adhesionRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'adhesions' => $adhesionRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

  

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/{id}", name="user_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, User $user): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($user);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('user_index');
    // }
}
