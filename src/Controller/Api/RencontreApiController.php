<?php

namespace App\Controller\Api;

use App\Repository\RencontreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api')]
final class RencontreApiController extends AbstractController
{
    #[Route('/rencontres', name: 'api_rencontres', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function rencontres(RencontreRepository $rencontreRepository): JsonResponse
    {
        $rencontres = $rencontreRepository->findAll();

        $data = [];
        foreach ($rencontres as $rencontre) {
            $data[] = [
                'id' => $rencontre->getId(),
                'domicile' => $rencontre->getClubDomicile()->getNom(),
                'exterieur' => $rencontre->getClubExterieur()->getNom(),
                'date' => $rencontre->getDate()->format('Y-m-d H:i'),
                'stade' => $rencontre->getStade()->getNom(),
                'prix' => $rencontre->getPrix(),
                'placesRestantes' => $rencontre->getPlacesRestantes(),
            ];
        }

        return $this->json($data);
    }
}