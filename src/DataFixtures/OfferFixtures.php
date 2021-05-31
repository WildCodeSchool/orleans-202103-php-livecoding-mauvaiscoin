<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture
{
    public const OFFERS = [
        [
            'title' => 'VHS',
            'description' => 'ma super cassette',
            'price' => 25
        ],
        [
            'title' => 'clous',
            'description' => 'des clous',
            'price' => 10
        ],
        [
            'title' => 'sac croco',
            'description' => 'lorem',
            'price' => 100
        ],
        [
            'title' => 'demi baguette rassie',
            'description' => 'lorem',
            'price' => 1
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OFFERS as $offerData) {
            $offer = new Offer();
            $offer->setTitle($offerData['title']);
            $offer->setDescription($offerData['description']);
            $offer->setPrice($offerData['price']);
            $manager->persist($offer);
        }

        $manager->flush();
    }
}
