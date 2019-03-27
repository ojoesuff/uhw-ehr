<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserStaff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;  

class StaffLoginBackend extends AbstractController {
    //initialise session
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/backend/staff/login", name="backend-staff-login") methods={"GET", "POST"}
     */   
     public function index() {

        $request = Request::createFromGlobals();

        $username = $request->request->get('username', 'none');
        $password = $request->request->get('password', 'none');
        $repo = $this->getDoctrine()->getRepository(UserStaff::class)->findOneBy([
            'username' => $username
        ]);
        
        //check hashed password from db
        if($repo) {
            $passwordCorrect = password_verify($password, $repo->getStaffPassword());
        } else {
            $passwordCorrect = false;
        }

        if($passwordCorrect) {
            
             //save data to session for authenication
            $id = $repo->getId();
            $staffType = $repo->getStaffType();
            $this->session->set('id', $id);
            $this->session->set('loggedIn', true);
            $this->session->set('staffType', $staffType);

            return new Response(
                "true"
            );
        } else {
            return new Response(
                "false"
            );
        }

     }
}