<?php

namespace App\Controller;

use App\Entity\UserStaff;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; //used to create custom url routes
use Symfony\Component\HttpFoundation\RedirectResponse;

class StaffLoginController extends AbstractController {
    /**
     * @Route("/staff/login", name="staff-login") methods={"GET", "POST"}
     */
    public function newAction(Request $request) {

        $login = new UserStaff();
        
        $form = $this->createForm(LoginType::class, $login);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $username = $form['username']->getData();
            $password = $form['staffPassword']->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $repo = $this->getDoctrine()->getRepository(UserStaff::class)->findOneBy([
                'username' => $username,
                'staffPassword' => $password,
            ]);  
            
            if($repo) {
                return $this->redirectToRoute('dashboard', array(), 301);
            }
            
    }

    return $this->render('staff-login.html.twig', array(
        'form' => $form->createView() 
    ));
}
}