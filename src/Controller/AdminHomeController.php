<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminHomeController extends Controller {
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index() {
        return $this->render('home.html.twig', []);
    }
}
