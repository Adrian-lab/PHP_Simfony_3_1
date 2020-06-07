<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class RoleController extends AbstractController
{
    /**
     * @Route("/role_controller", name="role_app")
     */
    public function rol(){
        $rol = $this->getUser()->getRol();
        if (in_array("ROLE_USER", $rols)){
            $users=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_USER");
            return $this->render('security/user.html.twig', ['listUser' => $users]);
        }
        else if (in_array("ROLE_SUPER", $rol)){
            $users=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_SUPER");
            $users2=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_USER");
            $totalUsers=array_merge($users, $users2);
            return  $this->render('security/user.html.twig', ['listUser' => $totalUsers]);
        }
        else if (in_array("ROLE_ADMIN", $rol)){
            $users=$this->getDoctrine()->getRepository(User::class)->findAll();
            return  $this->render('security/user.html.twig', ['listUser' => $users]);
        }
    }
}
?>