<?php

namespace App\Controller;

use App\Entity\Adhesion; 
use App\Entity\Count; 
use App\Entity\Image;
use App\Entity\User;
use App\Form\User1Type;
use App\Repository\AdhesionRepository;
use App\Repository\CountRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package ;
use Symfony\Component\Asset\Packages ;
use Symfony\Component\Asset\PathPackage ;
use Symfony\Component\Asset\UrlPackage ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
     /**
     * @Route("/commandecarte", name="user_commandecarte")
     */
    public function commandecarte(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $counts = $countRepository->findBy([
            'ref' => 'carte_2020'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
            return $this->render('user/commandecarte.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
     }  
        
        /**
     * @Route("/listetotal", name="user_listetotal")
     */
    public function listetotal(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $users = $userRepository->findAll();
         $adhesions = $adhesionRepository->findAll();
         $listusers[]='';
        
         foreach( $users as $user)
         {
            $adhesion = $user->getAdhesion();
            $listusers[]=$user;
            
             
         }  
         return $this->render('user/listetotal.html.twig', [
                'listusers' => $users,
                'adhesions' => $adhesions
                ]);
        } 
        
                /**
     * @Route("/listeadherent", name="user_listeadherent")
     */
    public function listeadherent(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $users = $userRepository->findAll();
         $adhesions = $adhesionRepository->findAll();
         $listusers[]='';
        
         foreach( $users as $user)
         {
            $adhesion = $user->getAdhesion();
            $role = $user->getRoles();
            
            $listusers[]=$user;
            
             
         }  
         return $this->render('user/listeadherent.html.twig', [
                'listusers' => $users,
                'adhesions' => $adhesions
                ]);
        }
    
         /**
     * @Route("/paiementadherent", name="user_paiementadherent")
     */
    public function paiementadherent(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $counts = $countRepository->findBy([
            'ref' => 'abonnement'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
            return $this->render('user/paiementadherent.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
     } 

              /**
     * @Route("/paiementdon", name="user_paiementdon")
     */
    public function paiementdon(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $counts = $countRepository->findBy([
            'ref' => 'don'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
            return $this->render('user/paiementdon.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
     }

                   /**
     * @Route("/paiementvente", name="user_paiementvente")
     */
    public function paiementvente(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
         $counts = $countRepository->findBy([
            'ref' => 'vente'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
            return $this->render('user/paiementvente.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
     }
        
    /**
     * @Route("/makeCarte", name="user_makeCarte")
     */
    public function makeCarte(UserRepository $userRepository, CountRepository $countRepository):Response
    {
        $users = $userRepository->findAll();
        $user = $this->getUser();
        $adhesion = $user->getAdhesion();
        $adhesionId = $adhesion->getId();
        $count = $countRepository->findOneByref('carte_2020');

        
        $adhesionfirstname = $adhesion->getFirstName();
        $adhesionlastname = $adhesion->getLastname();
        $adhesionbirthday = $adhesion->getBirthday();
        $adhesionlieunaiss = $adhesion->getlieunaissance();
        $adhesiongender = $adhesion->getGender();
        $adhesionprofession = $adhesion->getProfession();
        // $adhesionnorue = $adhesion->getNorue();
        // $adhesionnomrue = $adhesion->getNomrue();
        $adhesionville = $adhesion->getVille();
        $adhesionpays = $adhesion->getPays();
        $adhesioncodepostale = $adhesion->getCodepostale();
        
        $image = $adhesion->getImage();
        $imageId=$adhesion->getImage() ? $adhesion->getImage()->getId() : null;
        if(!$imageId)
        {
        return $this->render('images/echec_vue_image.html.twig');
            
        }
        $imageimagename = $image->getImageName();

        
        return $this->render('user/makeCarte.html.twig'
        ,[
            'count' => $count,
            // 'counts' => $counts,
            'adhesiongender'=> $adhesiongender,
            'adhesionId' => $adhesionId,
            'adhesionfirstname' => $adhesionfirstname,
            'adhesionlastname' => $adhesionlastname,
            'adhesionbirthday' => $adhesionbirthday,
            'adhesionlieunaiss' => $adhesionlieunaiss,
            'adhesionprofession'=> $adhesionprofession, 
            // 'adhesionnorue'=> $adhesionnorue,
            // 'adhesionnomrue'=> $adhesionnomrue,
            // 'adhesionville' => $adhesionville,
            // 'adhesionpays' => $adhesionpays,
            // 'adhesioncodepostale' => $adhesioncodepostale,
            // 'im' => $imageimagename
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
