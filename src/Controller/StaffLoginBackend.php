<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class StaffLoginBackend extends AbstractController {
    /**
     * @Route("/backend/staff/login", name="backend-staff-login") methods={"GET", "POST"}
     */   
     public function index() {

        $request = Request::createFromGlobals();

        $username = $request->request->get('username', 'none');
        $password = $request->request->get('password', 'none');
        $repo = $this->getDoctrine()->getRepository(UserStaff::class)->findOneBy([
            'username' => $username,
            'staffPassword' => $password,
        ]);

        if($repo) {

            // $session = new Session();
            // $session->start();
            
            //  //save data to session for authenication
            // $id = $repo->getId();
            // $staffType = $repo->getStaffType();
            // $session->set('id', $id);
            // $session->set('loggedIn', true);
            // $session->set('staffType', $staffType);

            return new Response(
                "true"
            );
        } else {
            return $this->render('staff-login.html.twig', [
                'loginError' => 'Username shit'
            ]);
        }

     }
}