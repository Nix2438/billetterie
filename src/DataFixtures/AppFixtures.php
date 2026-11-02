<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Rencontre;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Stade;
use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
    private UserPasswordHasherInterface $passwordHasher
) {
}
    public function load(ObjectManager $manager): void
    {
        $listeStades = [];
        $stades = [
            ['Stade des Pierres', 'Moirans', 35000],
            ['Chartreux', 'Voreppe', 28000],
            ['La Cabane', 'Rives', 63000],
            ['La Nat', 'Voiron', 60000],
            ['La Foire', 'Beaucroissant', 58500],
            ['Fontaine', 'Renage', 12000],

        ];
        foreach ($stades as $data) {
            $stade = new Stade();
            $stade->setNom($data[0]);
            $stade->setVille($data[1]);
            $stade->setCapacite($data[2]);
            $manager->persist($stade);
            $listeStades [] = $stade;}


        $listeClubs = [];
        $clubs = [
            ['FC Moirans', 'Moirans'],
            ['AS Voreppe', 'Voreppe'],
            ['Olympique de Rives', 'Rives'],
            ['Voiron Athletic', 'Voiron'],
            ['US Beaucroissant', 'Beaucroissant'],
            ['Renage FC', 'Renage'],
        ];

        foreach ($clubs as $i => $data) {
            $club = new Club();
            $club->setNom($data[0]);
            $club->setVille($data[1]);
            $club->setStade($listeStades[$i]);
            $manager->persist($club);
            $listeClubs[] = $club;

        }
        $dateDepart = new \DateTimeImmutable('2026-10-09 20:00');
$compteur = 0;

for ($i = 0; $i < count($listeClubs); $i++) {
    for ($j = $i + 1; $j < count($listeClubs); $j++) {
        $rencontre = new Rencontre();
        $rencontre->setClubDomicile($listeClubs[$i]);
        $rencontre->setClubExterieur($listeClubs[$j]);
        $rencontre->setStade($listeClubs[$i]->getStade());
        $rencontre->setPrix('10.00');
        $rencontre->setPlacesEnVente($listeClubs[$i]->getStade()->getCapacite());

        $semaine = intdiv($compteur, 3);
        $jour = $compteur % 3;
        $rencontre->setDate($dateDepart->modify('+' . ($semaine * 7 + $jour) . ' days'));

        $manager->persist($rencontre);
        $compteur++;
    }
}
$admin = new User();
$admin->setEmail('admin@billetterie.fr');
$admin->setRoles(['ROLE_ADMIN']);
$admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
$manager->persist($admin);

$user = new User();
$user->setEmail('user@billetterie.fr');
$user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
$manager->persist($user);

        $manager->flush();
    }
}
