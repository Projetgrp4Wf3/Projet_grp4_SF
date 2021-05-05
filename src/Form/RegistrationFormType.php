<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // Définition de la liste des années
        $years = range(date('Y')-100, date('Y')-18);
        rsort($years);

        $builder

            // Email
            ->add('email', EmailType::class, [
                'label' => "Votre adresse mail: ",
                'attr' => [
                    'placeholder' => "Saisir votre adresse mail"
                ],
                'required' => "true",
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse email est obligatoire !"
                    ]),
                    new Email([
                        'message' => "L'adresse mail n'est pas valide !"
                    ]),
                ]
            ])

            // Firstname
            ->add('firstname', TextType::class, [
                'label' => "Votre prénom: ",
                'required' => true,
                'attr' => [
                    'placeholder' => "Saisir vote prénom"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire !"
                    ])
                ]
            ])

            // Lastname
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom: ',
                'required' => true,
                'attr' => [
                    'placeholder' => "Saisir votre nom"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire !"
                    ])
                ]
            ])

            // Birthday
            ->add('birthday', BirthdayType::class, [
                'label' => "Votre date de naissance: ",
                'required' => true,
                'placeholder' => [
                    'year' => "Année",
                    'month' => "Mois",
                    'day' => "Jour"
                ],
                'years' => $years,
                'constraints' => [
                    new NotBlank([
                        'message' => "Ce champ est obligatoire !"
                    ])
                ]
            ])

            // Agree Terms
            ->add('agreeTerms', CheckboxType::class, [
                'label' => "Termes d'utilisations",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes d\'utilisations !',
                    ]),
                ],
            ])

            // Password
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => false,
                'required' => true,
                'mapped' => false,

                // Option du premier champ
                'first_options' => [
                    'label' => "Mot de passe: ",
                    'attr' => [
                        'placeholder' => "Saisir votre mot de passe"
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Nouveau mot de passe requis',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Le mot de passe doit contenir 6 caractères minimum !',
                            'max' => 32,
                            'maxMessage' => "Le mot de passe ne doit pas dépasser 32 caractères !"
                        ]),
                        new Regex([
                            'pattern' => "/^[a-z0-9]+/i",
                            'message' => "doit contenir des caractères alphabétique et numerique uniquement"
                        ])
                    ]
                ],

                // Option du second champ
                'second_options' => [
                    'label' => "Confirmation du mot de passe: ",
                    'attr' => [
                        'placeholder' => "Répétez votre nouveau mot de passe",
                    ]
                ],

                // Message d'erreur si les champs ne correspondent pas
                'invalid_message' => "Les champs ne sont pas identique."
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
