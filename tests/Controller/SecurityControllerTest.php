<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageEstAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    public function testAccueilEstAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }

    public function testCollectionRedirigeSiNonConnecte(): void
    {
        $client = static::createClient();
        $client->request('GET', '/collection');
        $this->assertResponseRedirects('/login');
    }

    public function testWishlistRedirigeSiNonConnecte(): void
    {
        $client = static::createClient();
        $client->request('GET', '/wishlist');
        $this->assertResponseRedirects('/login');
    }
}