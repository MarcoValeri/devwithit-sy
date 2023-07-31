<?php

namespace App\Controller;

use App\Repository\NodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NodeController extends AbstractController
{
    #[Route('/node/{slug}', name: 'app_node')]
    public function node(NodeRepository $nodeRepository, string $slug)
    {
        $node = $nodeRepository->findOneBy(['url' => $slug]);
        $nodeDate = $node->getCreated()->format('U');
        $todayDate = date('U');
        $nodeTutorials = $nodeRepository->findAll();

        if ($node && $todayDate > $nodeDate) {
            return $this->render("node/node.html.twig", [
                'node'          => $node,
                'nodeTutorials' => $nodeTutorials,
                'slug'          => $slug
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }

    #[Route('/node-tutorial', name: 'app_tutorial_node')]
    public function nodeArchive(NodeRepository $nodeRepository)
    {
        $nodeTutorials = $nodeRepository->findAll();

        return $this->render("node/node-tutorial.html.twig", [
            "pageTitle"     => "Node Tutorial",
            "nodeTutorials" => $nodeTutorials
        ]);
    }
}