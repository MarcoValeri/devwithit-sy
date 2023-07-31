<?php

namespace App\Controller;

use App\Repository\GuideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class GuideController extends AbstractController
{
    #[Route('/guide/{slug}', name: 'app_guide')]
    public function guide(GuideRepository $guideRepository, string $slug)
    {
        $guide = $guideRepository->findOneBy(['url' => $slug]);
        $guideDate = $guide->getCreated()->format('U');
        $todayDate = date('U');

        if ($guide && $todayDate > $guideDate) {
            return $this->render("guides/guide.html.twig", [
                'guide'     => $guide,
                'slug'      => $slug
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }

    }

    #[Route('/guides-page-{pageNumber}', name: 'app_archive_guides')]
    public function guideArchive(ManagerRegistry $doctrine, string $pageNumber)
    {
        $fromGuideNumber = $pageNumber * 10;
        $sqlQuery = "
            SELECT
                guide.url,
                guide.title,
                guide.created,
                guide.updated,
                guide.content,
                image.file_name,
                image.alternative_text
            FROM
                guide
            INNER JOIN
                image ON guide.image_id = image.id
            WHERE guide.created < NOW()
            ORDER BY created DESC
            LIMIT {$fromGuideNumber}, 10
        ";

        $conn = $doctrine->getConnection();
        $stmt = $conn->prepare($sqlQuery);
        $result = $stmt->executeQuery();
        $guides = $result->fetchAllAssociative();

        if (count($guides) > 0) {
            return $this->render("guides/guides-archive.html.twig", [
                'pageTitle'     => "Guides Archive",
                'guides'        => $guides,
                'pageNumber'    => $pageNumber
            ]);
        } else {
            return $this->redirectToRoute('app_error404');
        }
    }
}