<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Rencontre;
use App\Entity\Stade;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RencontreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text'
            ])
            ->add('prix')
            ->add('placesEnVente')
            ->add('clubDomicile', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'id',
            ])
            ->add('clubExterieur', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'id',
            ])
            ->add('stade', EntityType::class, [
                'class' => Stade::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rencontre::class,
        ]);
    }
}
