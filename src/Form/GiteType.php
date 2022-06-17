<?php

namespace App\Form;

use App\Entity\Gite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Entrez le nom du gite',
            ])
            ->add('description', TextType::class, [
                'label' => 'Entrez la description du gite',
            ])
            ->add('surface', IntegerType::class, [
                'label' => 'Entrez la surface du gite',
            ])
            ->add('bedrooms', IntegerType::class, [
                'label' => 'Entrez le nombre de chambres',
            ])
            ->add('beds', IntegerType::class, [
                'label' => 'Entrez le nombre de lits',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Entrez le prix du gite',
            ])
            ->add('adress', TextType::class, [
                'label' => 'Entrez l\'adresse du gite',
            ])
            ->add('zipcode', IntegerType::class, [
                'label' => 'Entrez le code postal du gite',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gite::class,
        ]);
    }
}
