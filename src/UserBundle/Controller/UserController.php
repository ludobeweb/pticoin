<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

/**
 * Description of UserController
 * @Security("has_role('ROLE_USER')")
 * @author jonathan-gomez
 */
class UserController extends Controller {

    /**
     * @Route("/profil", name="profil")
     */
    public function getProfil() {//Fonction pour récuperer les informations du profil de l'utilisateur connecté
        $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        //ci-dessous on récupère les utilisateurs par Username
        $monProfil = $repository->findBy(array('username' => $this->getUser()->getUsername()));

        return $this->render('admin/profil.html.twig', array('monProfil' => $monProfil));
    }


    /**
     *
     * @Route("/editprofil/{id}",name ="editprofil" )
     * @Template("admin/EditProfil.html.twig")
     */
    public function editProfil(Request $request, User $user) {
//        $deleteForm = $this->createDeleteForm($candidat);
        $editForm = $this->createForm(UserType::class, $user);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
//            return $this->redirectToRoute('profil.html.twig');
        }
        return $this->render('admin/EditProfil.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
        ));
    }
    


}
