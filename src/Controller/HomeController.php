<?php

namespace App\Controller;

use App\Repository\GuideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: "app_home")]
    public function home(GuideRepository $guideRepository)
    {

        // Get All Guides
        $guides = $guideRepository->findAll();

        return $this->render("pages/home.html.twig", [
            'guides'    => $guides
        ]);
    }
}