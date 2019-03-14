<?php

namespace App\Controller;

use App\Entity\UserStaff;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; //used to create custom url routes
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;


class StaffLoginController extends AbstractController {
    /**
     * @Route("/staff/login", name="staff-login") methods={"GET", "POST"}
     */
    public function newAction(Request $request) {

        $login = new UserStaff();
        
        $form = $this->createForm(LoginType::class, $login);

        $form->handleRequest($request);

        $loggedIn = false;

        if ($form->isSubmitted() && $form->isValid()) {

            $username = $form['username']->getData();
            $password = $form['staffPassword']->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $repo = $this->getDoctrine()->getRepository(UserStaff::class)->findOneBy([
                'username' => $username,
                'staffPassword' => $password,
            ]);  
            
            if($repo) {
                //store authenication in session to loads different views
                $id = $repo->getId();
                $staffType = $repo->getStaffType();
                $session = $request->getSession();
                $session->set('id', $id);
                $session->set('loggedIn', true);
                $session->set('staffType', $staffType);

                $loggedIn = true;


            } else {
                //send error message if username and password is not found
                return $this->render('staff-login.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Username or password incorrect'
                ));                

            }

            
            
    }

    return $this->render('staff-login.html.twig', array(
        'form' => $form->createView(),
        'loggedIn' => $loggedIn
    ));
}
}