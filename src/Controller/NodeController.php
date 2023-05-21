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

        if ($node) {
            return $this->render("nodes/node.html.twig", [
                'node' => $node,
                'slug' => $slug
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }
}