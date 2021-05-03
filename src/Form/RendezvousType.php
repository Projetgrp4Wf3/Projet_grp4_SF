<?php

namespace App\Form;

use App\Entity\Rendezvous;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
            [
                'Label' => "Entrer votre nom",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre nom",
                ],
                'help'=> "Le nom est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],
            ])

            ->add('prenom', TextType::class,
            [
                'Label' => "Entrer votre prenom",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre prénom",
                ],
                'help'=> "Le prénom est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],
            ])
            ->add('mail', EmailType::class,
            [
                'Label' => "Entrer votre mail",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre mail",
                ],
                'help'=> "Le mail est obligatoire et doit être valide!",
                'constraints'=> [
                    new NotBlank([
                        'message'=>"adresse mail obligatoire"
                    ]),
                    new Email([
                        'message'=> "adresse mail no valide"
                    ]),
                    new Unique([
                        'message'=> "adresse mail déjà utilisée"
                    ])

                ]
            ])
            ->add('numero', TextType::class,
            [
                'Label' => "Entrer votre numéro",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre numéro",
                ],
                'help'=> "Le numéro est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],
            ])
            ->add('adresse', TextType::class, 
            [
                'Label' => "Entrer votre adresse",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre adresse",
                ],
                'help'=> "Votre adresse est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],

            ])
            ->add('ville', TextType::class, 
            [
                'Label' => "Entrer votre ville",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre ville",
                ],
                'help'=> "La ville est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],

            ])
            ->add('code', TextType::class, 
            [
                'Label' => "Entrer votre Code Postal",
                'required' => true,
                'attr' => 
                [
                'placeholder' => "Entrer votre Code Postal",
                ],
                'help'=> "Le Code Postal est obligatoire",

                'constraints' => 
                [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ],

            ])
            ->add('domaine', EntityType::class, 
            [
                

            ]);

            


        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
