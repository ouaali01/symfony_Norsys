<?php


namespace App\Form;
use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('price', MoneyType::class)
            ->add('description', TextType::class)
            ->add('quantity',NumberType::class)
            ->add('TTC', CheckboxType::class, ['mapped' => false])
            ->add('category', CollectionType::class, [
                'entry_type'   => ChoiceType::class,
                'entry_options'  => [
                    'choices'  => [
                        'categ1' => 'Divices',
                        'categ2' => 'Cosmitique',
                        'categ3' => 'Accesoires',
                    ],
                    'choice_attr' => function($choice, $key, $value) {
                        return ['class' => 'attending_'.strtolower($key)];
                    },
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Ajout Produit'])
        ;
    }

}