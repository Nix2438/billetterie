<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Entity\Rencontre;
use App\Repository\BilletRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class BilletController extends AbstractController
{
    #[Route('/billet/reserver/{id}', name: 'app_billet_reserver')]
    #[IsGranted('ROLE_USER')]
    public function reserver(Rencontre $rencontre, EntityManagerInterface $em): Response
    {
        if ($rencontre->isComplet()) {
            $this->addFlash('error', 'Ce match est complet.');

            return $this->redirectToRoute('app_rencontre_show', ['id' => $rencontre->getId()]);
        }

        $billet = new Billet();
        $billet->setUser($this->getUser());
        $billet->setRencontre($rencontre);
        $billet->setDateAchat(new \DateTimeImmutable());

        $em->persist($billet);
        $em->flush();

        $this->addFlash('success', 'Votre place est réservée.');

        return $this->redirectToRoute('app_billet_mes_billets');
    }

    #[Route('/mes-billets', name: 'app_billet_mes_billets')]
    #[IsGranted('ROLE_USER')]
    public function mesBillets(BilletRepository $billetRepository): Response
    {
        $billets = $billetRepository->findBy(['user' => $this->getUser()]);

        return $this->render('billet/mes_billets.html.twig', [
            'billets' => $billets,
        ]);
    }
}