<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful(string $url): void
    {
        $client = self::createClient();
        /** @var UserRepository */
        $userRepository = static::$container->get(UserRepository::class);
        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('bilbo@baggins.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function urlProvider(): iterable
    {
        yield ['/'];
        yield ['/offer/'];
        yield ['/offer/1'];
        yield ['/offer/add'];
    }
}
