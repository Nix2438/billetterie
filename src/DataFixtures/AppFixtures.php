<?php

namespace App\DataFixtures;

use App\Entity\Stade;
use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
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
        $manager->flush();
    }
}
