<?php

namespace App\Form;

use App\Entity\Devi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DeviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('firstname', TextType::class, [
            'label' => "Votre prénom:",
            'required' => true,
            'attr' => [
                'placeholder' => "Saisir votre prénom"
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Ce champs est obligatoire !"
                ])
            ]
        ])


        ->add('lastname', TextType::class, [
            'label' => "Votre nom: ",
            'required' => true,
            'attr' => [
                'placeholder' => "Saisir votre nom"
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Ce champs est obligatoire !"
                ])
            ]
        ])

        ->add('email', EmailType::class, [
            'label' => "Email: ",
            'required' => true,
            'attr' => [
                'placeholder' => "Saisir votre adresse mail"
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Ce champs est obligatoire !"
                ])
            ]
        ])

        ->add('created_At', DateType::class, [
            'label' => "Date de création: ",
            'required' => true,
        ])

        ->add('montage', CheckboxType::class, [
            'label' => "Montage pneumatique 10€",
            'required' => false,
            'attr' => [
                'value' => 10
            ],
        ])

        ->add('depannage', CheckboxType::class, [
            'label' => "Dépannage pneumatique 15€",
            'required' => false,
            'attr' => [
                'value' => 15
            ]
        ])


        ->add('equilibre', CheckboxType::class, [
            'label' => "Équilibrage roue 10€",
            'required' => false,
            'attr' => [
                'value' => 10
            ]
        ])


        ->add('valve', CheckboxType::class, [
            'label' => "Changemement de valve 15€",
            'required' => false,
            'attr' => [
                'value' => 15
            ]
        ])


        ->add('plaquette', CheckboxType::class, [
            'label' => "Changement de plaquette de frein avant/arrière 10€",
            'required' => false,
            'attr' => [
                'value' => 10
            ]
        ])


        ->add('disque', CheckboxType::class, [
            'label' => "Changement disque de frein 15€",
            'required' => false,
            'attr' => [
                'value' => 15
            ]
        ])


        ->add('vidange', CheckboxType::class, [
            'label' => "Vidange Huile + filtre à huile 20€",
            'required' => false,
            'attr' => [
                'value' => 20
            ]
        ])

        
        ->add('price', MoneyType::class, [
            'label' => "Total des prestations: "
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devi::class,
        ]);
    }
}
