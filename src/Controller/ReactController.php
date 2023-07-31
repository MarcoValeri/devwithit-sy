<?php

namespace App\Controller;

use App\Repository\ReactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    #[Route('/react/{slug}', name: 'app_react')]
    public function react(ReactRepository $reactRepository, string $slug)
    {
        $react = $reactRepository->findOneBy(['url' => $slug]);
        $reactDate = $react->getCreated()->format('U');
        $todayDate = date('U');
        $reactTutorials = $reactRepository->findAll();

        if ($react && $todayDate > $reactDate) {
            return $this->render("react/react.html.twig", [
                'react'             => $react,
                'reactTutorials'    => $reactTutorials,
                'slug'              => $slug
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }

    #[Route('/react-tutorial', name: 'app_tutorial_react')]
    public function reactArchive(ReactRepository $reactRepository)
    {
        $reactTutorials = $reactRepository->findAll();

        return $this->render("react/react-tutorial.html.twig", [
            "pageTitle"         => "React Tutorial",
            "reactTutorials"    => $reactTutorials
        ]);
    }
}