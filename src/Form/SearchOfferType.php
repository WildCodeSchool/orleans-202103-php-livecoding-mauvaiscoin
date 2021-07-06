<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\SearchOffer;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('title', SearchType::class, [
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'required' => false,
            ])
            ->add('minPrice')
            ->add('maxPrice')
            ->add('sortByPrice', ChoiceType::class, [
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchOffer::class,
        ]);
    }
}
