<?php

namespace App\Tests\Entity;

use App\Entity\UserCollection;
use PHPUnit\Framework\TestCase;

class UserCollectionTest extends TestCase
{
    public function testQuantiteParDefautEstUn(): void
    {
        $item = new UserCollection();
        $this->assertEquals(1, $item->getQuantite());
    }

    public function testIsDuplicateRetourneFalseSiQuantiteEgaleUn(): void
    {
        $item = new UserCollection();
        $item->setQuantite(1);
        $this->assertFalse($item->isDuplicate());
    }

    public function testIsDuplicateRetourneTrueSiQuantiteSuperieurUn(): void
    {
        $item = new UserCollection();
        $item->setQuantite(2);
        $this->assertTrue($item->isDuplicate());
    }

    public function testUpdateEtatPossedeSiQuantiteUn(): void
    {
        $item = new UserCollection();
        $item->setQuantite(1);
        $this->assertEquals('possede', $item->getEtat());
    }

    public function testUpdateEtatDoublonSiQuantiteSuperieurUn(): void
    {
        $item = new UserCollection();
        $item->setQuantite(3);
        $this->assertEquals('doublon', $item->getEtat());
    }

    public function testDecrementQuantiteRepasseAPossede(): void
    {
        $item = new UserCollection();
        $item->setQuantite(2); // doublon
        $item->setQuantite(1); // repasse à possede
        $this->assertEquals('possede', $item->getEtat());
        $this->assertFalse($item->isDuplicate());
    }
}