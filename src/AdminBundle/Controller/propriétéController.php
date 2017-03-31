<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        

class propriétéController extends Controller
{
    /**
     * @Route("/editprofil1/{id}")
     * 
     * @param Request $r
     */
    public function updateUser(Request $r,$id){
        $user = $this->getDoctrine()->getRepository(\UserBundle\Entity\User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        //remplir pour mettre a jour la propriété
        $user->setNom("nom");
        
        $user->setPrenom("prenom");
        
        $user->setUsername("username");
        $em->merge($user);
        $em->flush();
        
    return new JsonResponse($user);


        
    }
}