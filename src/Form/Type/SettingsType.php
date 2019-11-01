<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Currency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;

final class SettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.name',
                'constraints' => [new Length(['min' => 2])],
            ])
            ->add('title', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.title',
                'constraints' => [new Length(['min' => 8])],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.description',
                'constraints' => [new Length(['min' => 8])],
            ])
            ->add('custom_code', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
                'label' => 'label.settings.code',
            ])
            ->add('items_per_page', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.limit',
                'constraints' => [new Range(['min' => 3, 'max' => 100])],
            ])
            ->add('currency', EntityType::class, [
                'class' => Currency::class,
                'choice_label' => 'currency_title',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.currency',
            ])
            ->add('ymaps_key', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
                'label' => 'label.settings.ymaps_key',
            ])
            ->add('map_center', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'placeholder.map_center_example',
                ],
                'required' => false,
                'label' => 'label.settings.map_center',
            ])
            ->add('map_zoom', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'label.settings.map_zoom',
                'constraints' => [new Range(['min' => 0, 'max' => 19])],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}