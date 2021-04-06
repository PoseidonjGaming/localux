<?php

namespace App\Form;

use App\Entity\LocationSansChauffeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocSansChauffTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateLocation')
            ->add('montantRegle')
            ->add('dateHreDepartPrevu')
            ->add('dateHreDepartReel')
            ->add('dateHreRetourPrevu')
            ->add('dateHreRetourReel')
            ->add('nbKmsDepart')
            ->add('nbKmRetour')
            ->add('leVehicule')
            ->add('leClient')
            ->add('laFormuleSC', EntityType::class, [            
                'class' => FormuleSansChauffeur::class,            
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');},
                'multiple' => false,
                'expanded' => false,
                'mapped'=>false,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LocationSansChauffeur::class,
        ]);
    }
}
