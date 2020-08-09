<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Person
{
    const ROMANIAN_NATIONALITY = 'romanian';
    const OTHER_NATIONALITY = 'other';

    const FEMALE = 'female';
    const MALE = 'male';

    const ROMANIA_COUNTY_CODE_AND_NAME = [
        'Alba' => '01',
        'Arad' => '02',
        'Argeș' => '03',
        'Bacău' => '04',
        'Bihor' => '05',
        'Bistrița-Năsăud' => '06',
        'Botoșani' => '07',
        'Brașov' => '08',
        'Brăila' => '09',
        'Buzău' => '10',
        'Caraș-Severin' => '11',
        'Cluj' => '12',
        'Constanța' => '13',
        'Covasna' => '14',
        'Dâmbovița' => '15',
        'Dolj' => '16',
        'Galați' => '17',
        'Gorj' => '18',
        'Harghita' => '19',
        'Hunedoara' => '20',
        'Ialomița' => '21',
        'Iași' => '22',
        'Ilfov' => '23',
        'Maramureș' => '24',
        'Mehedinți' => '25',
        'Mureș' => '26',
        'Neamț' => '27',
        'Olt' => '28',
        'Prahova' => '29',
        'Satu Mare' => '30',
        'Sălaj' => '31',
        'Sibiu' => '32',
        'Suceava' => '33',
        'Teleorman' => '34',
        'Timiș' => '35',
        'Tulcea' => '36',
        'Vaslui' => '37',
        'Vâlcea' => '38',
        'Vrancea' => '39',
        'București' => '40',
        'București - Sector 1' => '41',
        'București - Sector 2' => '42',
        'București - Sector 3' => '43',
        'București - Sector 4' => '44',
        'București - Sector 5' => '45',
        'București - Sector 6' => '46',
        'Călărași' => '51',
        'Giurgiu' => '52',
    ];

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false,
     *      charset = 'UTF-8'
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private $name;
    /**
     * @Assert\Choice(
     *     choices = { "female", "male" },
     *     message = "Choose a valid genre."
     * )
     */
    private $gender;
    /**
     * @Assert\DateTime
     */
    private $dateOfBirth;
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false,
     *      charset = 'UTF-8'
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private $nationality;
    /** @var bool */
    private $isRomanianResident;
    /** @var string */
    private $county;
    /**
     * @Assert\NotBlank
     * @Assert\Length(13)
     */
    private $cnp;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Person
     */
    public function setName(string $name): Person
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Person
     */
    public function setGender(string $gender): Person
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     * @return Person
     */
    public function setDateOfBirth(\DateTime $dateOfBirth): Person
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getNationality(): string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     * @return Person
     */
    public function setNationality(string $nationality): Person
    {
        $this->nationality = $nationality;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRomanianResident(): bool
    {
        return $this->isRomanianResident;
    }

    /**
     * @param bool $isRomanianResident
     * @return Person
     */
    public function setIsRomanianResident(bool $isRomanianResident): Person
    {
        $this->isRomanianResident = $isRomanianResident;
        return $this;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @param string $county
     * @return Person
     */
    public function setCounty(string $county): Person
    {
        $this->county = $county;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnp(): string
    {
        return $this->cnp;
    }

    /**
     * @param string $cnp
     * @return Person
     */
    public function setCnp(string $cnp): Person
    {
        $this->cnp = $cnp;
        return $this;
    }
}
