<?php

namespace App\Service;

use App\Entity\Person;

class CnpService
{
    public function isCnpValid(Person $person): bool
    {
        if (!$this->hasValidLength($person->getCnp())) {
            return false;
        }

        if (!$this->hasValidGenderDigit($person)) {
            return false;
        }

        if (!$this->hasValidYearDigits($person)) {
            return false;
        }

        if (!$this->hasValidMonthDigits($person)) {
            return false;
        }

        if (!$this->hasValidDayDigits($person)) {
            return false;
        }

        if (!$this->hasValidCountyDigits($person)) {
            return false;
        }

        if (!$this->hasValidControlDigit($person)) {
            return false;
        }

        return true;
    }

    private function hasValidLength(string $cnp): bool
    {
        if (strlen($cnp) === 13) {
            return true;
        }

        return false;
    }

    private function hasValidGenderDigit(Person $person): bool
    {
        $cnp = $person->getCnp();

        $genderDigits = substr($cnp, 0, 1);

        $start18th = (new \DateTime( '1800-01-01'))->format('Y-m-d');
        $end18th = (new \DateTime( '1899-12-31'))->format('Y-m-d');

        $start19th = (new \DateTime( '1900-01-01'))->format('Y-m-d');
        $end19th = (new \DateTime('1999-12-31'))->format('Y-m-d');

        $start20th = (new \DateTime( '2000-01-01'))->format('Y-m-d');
        $end20th = (new \DateTime( '2099-12-31'))->format('Y-m-d');

        if ($person->getNationality() !== Person::ROMANIAN_NATIONALITY && $genderDigits != 9) {
            return false;
        }

        if ($person->isRomanianResident() && $person->getNationality() !== Person::ROMANIAN_NATIONALITY) {
            if (($person->getGender() === Person::FEMALE && $genderDigits == 8) ||
                ($person->getGender() === Person::MALE && $genderDigits == 7)) {
                return true;
            }
            return false;
        }

        $dateOfBirth = $person->getDateOfBirth()->format('Y-m-d');

        if( strtotime($dateOfBirth) >= strtotime($start18th) && strtotime($dateOfBirth) <= strtotime($end18th)) {
            if (($person->getGender() === Person::FEMALE && $genderDigits == 4) ||
                ($person->getGender() === Person::MALE && $genderDigits == 3)) {
                return true;
            }
            return false;
        }

        if(strtotime($dateOfBirth) >= strtotime($start19th) && strtotime($dateOfBirth) <= strtotime($end19th)) {
            if (($person->getGender() === Person::FEMALE && $genderDigits == 2) ||
                ($person->getGender() === Person::MALE && $genderDigits == 1)) {
                return true;
            }
            return false;
        }

        if( strtotime($dateOfBirth) >= strtotime($start20th) && strtotime($dateOfBirth) <= strtotime($end20th)) {
            if (($person->getGender() === Person::FEMALE && $genderDigits == 6) ||
                ($person->getGender() === Person::MALE && $genderDigits == 5)) {
                return true;
            }
            return false;
        }

        return false;
    }

    private function hasValidYearDigits(Person $person): bool
    {
        $cnp = $person->getCnp();

        $yearDigits = substr($cnp, 1, 2);
        $yearOfBirth = date("Y", strtotime($person->getDateOfBirth()->format('Y-m-d')));

        if ($yearDigits === substr($yearOfBirth, 2, 2)) {
            return true;
        }

        return false;
    }

    private function hasValidMonthDigits(Person $person): bool
    {
        $cnp = $person->getCnp();

        $monthDigits = substr($cnp, 3, 2);
        $monthOfBirth = date("m", strtotime($person->getDateOfBirth()->format('Y-m-d')));

        if ($monthDigits === $monthOfBirth) {
            return true;
        }

        return false;
    }

    private function hasValidDayDigits(Person $person): bool
    {
        $cnp = $person->getCnp();

        $dayDigits = substr($cnp, 5, 2);
        $dayOfBirth = date("d", strtotime($person->getDateOfBirth()->format('Y-m-d')));

        if ($dayDigits === $dayOfBirth) {
            return true;
        }

        return false;
    }

    private function hasValidCountyDigits(Person $person): bool
    {
        $cnp = $person->getCnp();

        $countyDigits = substr($cnp, 7, 2);
        $county = $person->getCounty();

        if (array_key_exists($county, Person::ROMANIA_COUNTY_CODE_AND_NAME) &&
            $countyDigits == Person::ROMANIA_COUNTY_CODE_AND_NAME[$county]) {
            return true;
        }

        return false;
    }

    private function hasValidControlDigit(Person $person): bool
    {
        $cnp = $person->getCnp();

        $controlDigit = substr($cnp, 12, 1);

        $sum = $this->getControlSum($cnp);

        $expectedLastDigit = $sum%11;

        if ($expectedLastDigit === 10) {
            $expectedLastDigit = 1;
        }

        if ($controlDigit == $expectedLastDigit) {
            return true;
        }

        return false;
    }

    private function getControlSum(string $cnp): int
    {
        $helper = '279146358279';
        $usedCnpDigits = substr($cnp, 0, 12);

        $sum = 0;

        for ($i=0; $i<=strlen($helper); $i++) {
            $sum = $sum + (int)substr($usedCnpDigits, $i, 1) * (int)substr($helper, $i, 1);
        }

        return $sum;
    }

}
