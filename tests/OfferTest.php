<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class OfferTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/offer');

        $this->assertSelectorTextContains('h1', 'Ma recherche');
        $client->takeScreenshot('tests/screenshot/offer.png');
    }

    public function testCard(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/offer');

        $this->assertCount(4, $crawler->filter('.card'));
        $client->takeScreenshot('tests/screenshot/offer.png');
    }
}
