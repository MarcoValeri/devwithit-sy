<?php

namespace App\Controller;

use App\Repository\GuideRepository;
use App\Repository\NodeRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function sitemap(GuideRepository $guideRepository, NodeRepository $nodeRepository)
    {
        $guides = $guideRepository->findAll();
        $nodeTutorials = $nodeRepository->findAll();

        return $this->render('seo/sitemap.html.twig', [
            'guides'        => $guides,
            'nodeTutorials' => $nodeTutorials,
        ]);
    }
}