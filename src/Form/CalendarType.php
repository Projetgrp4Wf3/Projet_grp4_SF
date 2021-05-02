<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "RDV + Nom et prénom :",
                'required' => true
            ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => "Date de début: "
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => "Date de début: "
            ])
            ->add('description', TextareaType::class, [
                'label' => "Détaillez les prestations choisis :",
                'required' => true,
                'attr' => [
                    'placeholder' => "Montage pneumatique + ..."
                ],
                'help' => "Merci de renseigner aussi votre numéro et adresse mail dans le champs pour que l'on puisse vous contacter."
            ])
            ->add('all_day', CheckboxType::class, [
                'label' => "Réserver la journée",
                'required' => false
            ])
            ->add('background_color', ColorType::class, [
                'label' => "Choisissez la couleur de fond"
            ])
            ->add('border_color', ColorType::class, [
                'label' => "Choisissez la couleur de bordure"
            ])
            ->add('text_color', ColorType::class, [
                'label' => "Choisissez la couleur du texte"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
