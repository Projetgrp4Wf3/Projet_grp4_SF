<?php

namespace App\Form;

use App\Entity\Entretien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class EntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, [
            'label' => "Titre de l'entretien",
            'label_attr' => [
                'class' => "",
            ],
            'required' => true,
            'attr' => [
                'class' => "",
                'placeholder' => "Saisir le titre de l'entretien",
            ],
            'help' => "le titre sera affiché publiquement.",
            'help_attr' => [
                'class' => "",
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "le titre est obligatoire"
                ])
            ],
        ])

        ->add('description', TextareaType::class, [
            'label' => "Description de l'entretien",
            'label_attr' => [
                'class' => "",
            ],
            'required' => true,
            'attr' => [
                'class' => "",
                'placeholder' => "Saisir la description de l'entretien.",
            ],
            'help' => "Cette description sera affichée publiquement.",
            'help_attr' => [
                'class' => "",
            ],
            'constraints' => [
                new Length([
                    'max' => 1000,
                    'maxMessage' => "La description ne doit pas dépasser 1000 caractères" 
                ])
            ],
        ])
        ->add('price', MoneyType::class, [
            'label' => "Prix",
            'label_attr' => [
                'class' => "",
            ],
            'required' => true,
            'attr' => [
                'class' => "",
                'placeholder' => "Saisir le prix",
            ],
            'help' => "Le prix sera affiché publiquement.",
            'help_attr' => [
                'class' => "",
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Le prix est obligatoire."
                ]),
                new GreaterThan([
                    'value' => 0,
                    'message' => "Le prix est obligatoirement supérieur à 0 euros."
                ]),
                new LessThanOrEqual([
                    'value' => 9999.99,
                    'message' => "Le prix doit être obligatoirement inférieur à 9999.99 euros."
                ])
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entretien::class,
        ]);
    }
}
