<?php

namespace App\Form;

use App\Entity\Seller;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerType extends AbstractType
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * SellerType constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company')
            ->add('contacts')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choices' => $this->userRepository->findWithoutSeller(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seller::class,
        ]);
    }
}
