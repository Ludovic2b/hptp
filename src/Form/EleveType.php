<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Eleve;
use App\Entity\Maison;
use App\Entity\Sortilege;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sortileges', EntityType::class, [
                'class' => Sortilege::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('maison', EntityType::class, [
                'class' => Maison::class,
                'choice_label' => 'nom',
                'required' => False,
                'placeholder' => "Aucune"
            ])
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
