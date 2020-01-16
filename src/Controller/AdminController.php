<?php

namespace App\Controller;

use App\Services\Stats;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * Cette route permet de gérer le tableau de bord
     *  @Route("/admin", name="admin_dashboard")
     * @return void
     */
    public function dashboard(Stats $statsService) 
    {
        return $this->render('admin/dashboard.html.twig', 
        [
            'stats' => $statsService->getStats(),
        ]);
    }

    /**
     * @Route("/admin/login", name="admin_account_login")
     */
    public function adminLogin(AuthenticationUtils $auth)
    {
        return $this->render('admin/login.html.twig', 
        [
            'username' => $auth->getLastUsername(),
            'hasError' => $auth->getLastAuthenticationError() !== null,
        ]);
    }

    /**
     * @Route("/admin/deconnexion", name="admin_deconnexion")
     */
    public function adminDeconnexion(){}

}
