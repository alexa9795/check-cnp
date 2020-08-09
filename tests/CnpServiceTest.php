<?php

namespace App\Tests;

use App\Entity\Person;
use App\Service\CnpService;
use PHPUnit\Framework\TestCase;

class CnpServiceTest extends TestCase
{
    public function testIsCnpValid()
    {
        $person = (new Person())->setName('test')
            ->setGender(Person::MALE)
            ->setDateOfBirth(new \DateTime('1975-10-10 00:00:00.0'))
            ->setNationality(Person::ROMANIAN_NATIONALITY)
            ->setIsRomanianResident(false)
            ->setCounty('Timiș')
            ->setCnp('2751010351235');

        $result = $this->createMock(CnpService::class)->isCnpValid($person);

        static::assertFalse($result);
    }
}
