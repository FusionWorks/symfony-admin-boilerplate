<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Seller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('file', FileType::class, [
                'label' => 'Upload logo (.jpeg, .jpg, .png)',
                'required'=> false
            ])
            ->add('seller', EntityType::class, [
                'class' => Seller::class,
                'choice_label'  => 'user'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
