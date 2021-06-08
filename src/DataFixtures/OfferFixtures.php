<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
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
            $offer->setCategory($this->getReference('category' . rand(0, count(CategoryFixtures::CATEGORIES) - 1)));
            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
