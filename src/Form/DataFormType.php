<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class DataFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextareaType::class, [
                'label' => 'Name: ',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender: ',
                'choices' => [
                    'Female' => 'female',
                    'Male' => 'male',
                ]])
            ->add('dateOfBirth', DateType::class, [
                'label' => 'Date of birth: ',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('nationality', ChoiceType::class, [
                'label' => 'Nationality: ',
                'choices' => [
                    'Romanian' => Person::ROMANIAN_NATIONALITY,
                    'Other' => 'Male',
                ]])
            ->add('isRomanianResident', CheckboxType::class, [
                'label' => 'Is romanian resident? ',
                'required' => false,
            ])
            ->add('cnp', TextareaType::class, [
                'label' => 'CNP: ',
                'trim' => true
            ])
            ->add('county', ChoiceType::class, [
                'label' => 'County of birth: ',
                'choices' => [
                    'Alba' => 'Alba',
                    'Arad' => 'Arad',
                    'Argeș' => 'Argeș',
                    'Bacău' => 'Bacău',
                    'Bihor' => 'Bihor',
                    'Bistrița-Năsăud' => 'Bistrița-Năsăud',
                    'Botoșani' => 'Botoșani',
                    'Brașov' => 'Brașov',
                    'Brăila' => 'Brăila',
                    'Buzău' => 'Buzău',
                    'Caraș-Severin' => 'Caraș-Severin',
                    'Cluj' => 'Cluj',
                    'Constanța' => 'Constanța',
                    'Covasna' => 'Covasna',
                    'Dâmbovița' => 'Dâmbovița',
                    'Dolj' => 'Dolj',
                    'Galați' => 'Galați',
                    'Gorj' => 'Gorj',
                    'Harghita' => 'Harghita',
                    'Hunedoara' => 'Hunedoara',
                    'Ialomița' => 'Ialomița',
                    'Iași' => 'Iași',
                    'Ilfov' => 'Ilfov',
                    'Maramureș' => 'Maramureș',
                    'Mehedinți' => 'Mehedinți',
                    'Mureș' => 'Mureș',
                    'Neamț' => 'Neamț',
                    'Olt' => 'Olt',
                    'Prahova' => 'Prahova',
                    'Satu Mare' => 'Satu Mare',
                    'Sălaj' => 'Sălaj',
                    'Sibiu' => 'Sibiu',
                    'Suceava' => 'Suceava',
                    'Teleorman' => 'Teleorman',
                    'Timiș' => 'Timiș',
                    'Tulcea' => 'Tulcea',
                    'Vaslui' => 'Vaslui',
                    'Vâlcea' => 'Vâlcea',
                    'Vrancea' => 'Vrancea',
                    'București' => 'București',
                    'București - Sector 1' => 'București - Sector 1',
                    'București - Sector 2' => 'București - Sector 2',
                    'București - Sector 3' => 'București - Sector 3',
                    'București - Sector 4' => 'București - Sector 4',
                    'București - Sector 5' => 'București - Sector 5',
                    'București - Sector 6' => 'București - Sector 6',
                    'Călărași' => 'Călărași',
                    'Giurgiu' => 'Giurgiu',
                ]
            ]);
    }
}
