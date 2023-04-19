<?php

namespace App\Controller;

use App\Repository\GuideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GuideController extends AbstractController
{
    #[Route('/guide/{slug}', name: 'app_guide')]
    public function guide(GuideRepository $guideRepository, string $slug)
    {
        $guide = $guideRepository->findOneBy(['url' => $slug]);

        if ($guide) {
            return $this->render("guides/guide.html.twig", [
                'guide'    => $guide,
                'slug'      => $slug
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }

    }
}