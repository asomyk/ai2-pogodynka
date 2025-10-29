<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Enter city name',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'France' => 'FR',
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'United Kingdom' => 'GB',
                    'United States' => 'US',
                ],
                'placeholder' => 'Select country',
            ])
            ->add('latitude', NumberType::class, [
                'html5' => true,
                'scale' => 6,
                'attr' => [
                    'placeholder' => 'ex. 52.229675',
                    'step' => '0.000001',
                ],

            ])
            ->add('longitude', NumberType::class, options: [
                'html5' => true,
                'scale' => 6,
                'attr' => [
                    'placeholder' => 'ex. 21.012230',
                    'step' => '0.000001',
                ],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
